<?php

declare(strict_types=1);

namespace CrossSelling\Loop;

use Propel\Runtime\Propel;
use Thelia\Core\Template\Element\ArraySearchLoopInterface;
use Thelia\Core\Template\Element\BaseLoop;
use Thelia\Core\Template\Element\LoopResult;
use Thelia\Core\Template\Element\LoopResultRow;
use Thelia\Core\Template\Loop\Argument\Argument;
use Thelia\Core\Template\Loop\Argument\ArgumentCollection;

/**
 * Visible products bought in the same orders as the given product.
 *
 * @method int|null getProductId()
 */
class OrderedProductLoop extends BaseLoop implements ArraySearchLoopInterface
{
    protected function getArgDefinitions(): ArgumentCollection
    {
        return new ArgumentCollection(
            Argument::createIntTypeArgument('product_id')
        );
    }

    public function buildArray(): array
    {
        $productId = (int) $this->getProductId();

        $query = 'SELECT p.id AS product_id FROM product p
            INNER JOIN order_product op ON op.product_ref = p.ref
            WHERE p.visible = 1 AND p.id <> :product_id
            AND op.order_id IN (
                SELECT op2.order_id FROM order_product op2
                INNER JOIN product p2 ON p2.ref = op2.product_ref
                WHERE p2.id = :product_id
            )
            GROUP BY p.id ORDER BY RAND()';

        $stmt = Propel::getConnection()->prepare($query);
        $stmt->execute([':product_id' => $productId]);

        return array_map('intval', $stmt->fetchAll(\PDO::FETCH_COLUMN));
    }

    public function parseResults(LoopResult $loopResult): LoopResult
    {
        foreach ($loopResult->getResultDataCollection() as $productId) {
            $loopResultRow = new LoopResultRow();
            $loopResultRow->set('ID', $productId);
            $loopResult->addRow($loopResultRow);
        }

        return $loopResult;
    }
}
