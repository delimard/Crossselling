Crossselling module
==================
author: Delimard <support@delimard.fr>

<a href="https://www.buymeacoffee.com/delimard" target="_blank"><img src="https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png" alt="Buy Me A Coffee" style="height: 41px !important;width: 174px !important;box-shadow: 0px 3px 2px 0px rgba(190, 190, 190, 0.5) !important;-webkit-box-shadow: 0px 3px 2px 0px rgba(190, 190, 190, 0.5) !important;" ></a>



Sommaire
-------
Module de vente pour Thelia E-commerce. Ce module vous permet d'afficher les produits que les clients on aussi acheté.

Français:
1.  Installation
2.  Utilisation et Intégration
 


### Installation

#### Manuelle

* Copiez le module dans le dossier ```<thelia_root>/local/modules/```  et assurez-vous que le nom du module est bien Crossselling.
* Activez le depuis votre interface d'administration Thelia.


### Utilisation et Intégration

#### Loop

```
{loop name="crosscheck" type="crossselling" product_id=$product_id limit="1"}
    {if isset($ID)}
            {$product_check=1}
    {else}
    {/if}
 {/loop}
 
{if isset($product_check)}  
    <div class="block-title">
        <h4 class="text-center">Nos clients, qui ont achété ce produit, ont aussi commandé :</h4>
    </div>
    <div class="row mt-4">
        {loop name="crossselling" type="crossselling" product_id=$product_id limit="4"}
            <div class="col-sm-4 col-lg-3">
                {loop name="accessproduct" type="product" id="{$ID}"}
                    {include file="includes/single-product.html"}
                 {/loop} 
            </div>
        {/loop}  
    </div>    
{else}
{/if}

```




