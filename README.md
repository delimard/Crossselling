# 🛒 Crossselling Module for Thelia

**Auteur / Author**: [Delimard](mailto:support@delimard.fr)

<div align="center">
  <a href="https://www.buymeacoffee.com/delimard" target="_blank">
    <img src="https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png" alt="Buy Me A Coffee" width="174">
  </a>
</div>

---

## 📌 À propos / About

**FR** : Le module **Crossselling** pour **Thelia** permet d’afficher des suggestions de produits basées sur les achats d'autres clients.  
**EN** : The **Crossselling** module for **Thelia** displays product suggestions based on what other customers also bought.

> 🧠 *"Les clients qui ont acheté ce produit ont aussi commandé..."*  
> 🧠 *"Customers who bought this item also purchased..."*

---

## 📦 Fonctionnalités / Features

- FR : Affichage automatique de produits fréquemment achetés ensemble  
- EN : Automatically displays frequently co-purchased products

- FR : Facile à intégrer dans vos templates  
- EN : Easy to integrate into your templates

- FR : Léger et performant  
- EN : Lightweight and efficient

- FR : Idéal pour booster les ventes croisées  
- EN : Perfect for boosting cross-sales

---

## 🛠️ Installation

### 🔧 Manuelle / Manual

**FR** :

1. Téléchargez ou clonez ce dépôt.
2. Copiez le dossier du module dans : /local/modules/Crossselling/
Le nom du dossier **doit être `Crossselling`**.
3. Activez le module via le back-office de Thelia.

**EN** :

1. Download or clone this repository.
2. Copy the module folder to: /local/modules/Crossselling/
Make sure the folder name is exactly **Crossselling**.
3. Activate the module from the Thelia back-office.

---

## 🧩 Utilisation / Usage

### 📄 Intégration dans le template / Template integration

Voici un exemple de boucle Smarty à placer dans `product.html` ou un autre template produit.  
Here is a sample Smarty loop to include in `product.html` or another product template.

```smarty
{loop name="crosscheck" type="crossselling" product_id=$product_id limit="1"}
 {if isset($ID)}
     {$product_check=1}
 {/if}
{/loop}

{if isset($product_check)}  
 <div class="block-title">
     <h4 class="text-center">Nos clients, qui ont acheté ce produit, ont aussi commandé :</h4>
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
{/if}
```
## 🙌 Support

FR : Une question ? Un bug ? Une idée ? Contactez-nous :
EN : Got a question? A bug? An idea? Contact us:
📧 support@delimard.fr

## ☕ Soutenir le projet / Support this project

Si ce module vous a été utile, pensez à offrir un café ! 💖
If you found this module useful, consider buying a coffee! 💖
