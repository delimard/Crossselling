<?php

namespace CrossSelling\Loop;

use Propel\Runtime\Connection\SqlConnectionInterface;
use Propel\Runtime\Propel;
use Thelia\Core\Template\Element\ArraySearchLoopInterface;
use Thelia\Core\Template\Element\BaseLoop;
use Thelia\Core\Template\Element\LoopResult;
use Thelia\Core\Template\Element\LoopResultRow;
use Thelia\Core\Template\Loop\Argument\Argument;
use Thelia\Core\Template\Loop\Argument\ArgumentCollection;

class OrderedProductLoop extends BaseLoop implements ArraySearchLoopInterface
{
    protected function getArgDefinitions()
    {
        return new ArgumentCollection(
            //Argument::createIntListTypeArgument('product_id')
            Argument::createIntTypeArgument('product_id')
        );
    }

    public function buildArray()
    {
        $productId = $this->getProductId();
     
        /** @var SqlConnectionInterface $con */
        $con = Propel::getConnection();

        $query = "SELECT product.id as product_id FROM product
                 WHERE product.ref IN(
                     SELECT DISTINCT order_product.product_ref FROM order_product
                    RIGHT JOIN product_sale_elements ON order_product.product_ref = product_sale_elements.ref
                    JOIN product ON product_sale_elements.id = product.id
                    WHERE  product.visible = 1 AND order_product.order_id IN(
                        SELECT `order`.id FROM `order`
                        WHERE `order`.id IN(
                             SELECT order_product.order_id FROM order_product 
                             WHERE order_product.product_ref IN (SELECT product.ref from product where product.id='$productId')
                        )
                    )
                 ) AND NOT product.id='$productId'

ORDER BY RAND()";

        


        $stmt = $con->prepare($query);
        $stmt->execute();

        $results = [];

        while ($result = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $results[] = $result['product_id'];
        }

        return $results;
    }

    public function parseResults(LoopResult $loopResult)
    {
        foreach ($loopResult->getResultDataCollection() as $resultat) {
            $loopResultRow = new LoopResultRow();

            $loopResultRow->set("ID", $resultat);

            $loopResult->addRow($loopResultRow);
        }

        return $loopResult;
    }
}
