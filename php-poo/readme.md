
# PHP POO


## Objet en POO (Programmation Orienté Objet)


### Les classes


- C'est quoi une classe ? **Une classe est le moule**
- Une classe s'écrit en PHP avec le mot-clé `class ClassName`
  - Produire des instances de la classe (des objets) qui seront tous créés de la même manière
  - Ils vont partager leurs attributs (_ils auront tous les mêmes nom d'attributs, mais pas forcément les mêmes valeurs !_) & méthodes
  - notion de visibilité, il s'agit de mot-clé qui s'appliquent sur les éléments de classe (attributs/méthodes/constructeur) :
      - **public** : l'élément est accessible de partout en dehors de la classe
      - **protected** : l'élément est accessible seulement aux classes enfants, pas en dehors de la classe
      - **private** : l'élément n'est pas accessible en dehors de la classe
  - **Encapsulation** de la classe :
    - c'est le fait de laisser le choix à la classe de comment on accède à ses attributs et méthodes
    - les attributs ne sont pas publique (sauf dans le cadre de DTO, **D**ata **T**ransfert **O**bject : avoir un objet non-persisté en base de données, souvent ses attributs sont publiques)
    - on accède aux attributs par le biais de GETTER/SETTER, qui sont des méthodes publiques permettant de modifier/récupérer l'attribut
- Le **__constructor**, il s'agit de comment la classe doit être instanciée, il est appelé lorque l'on fait un `new`
- **Un objet est une instance de classe**
- `final` : ce mot-clé se place sur un attribut `objet` ou une méthode ou une classe, il aide à la compréhension du code : 
  - Sur une classe, il indique que la classe définie **tout ses attributs à la création et qu'ils ne changeront jamais** (service)
  - Sur un attribut, il indique que l'attribut prend une valeur et ne changera jamais (service/controller)
  - Sur une méthode, il indique que la méthode ne pourra pas être redéfinie par ses enfants
- `const` : déclarer des constantes dans la classe, ce sont des attributs de type "primitif" (string, int, etc) dont la valeur ne changera jamais (on peut voir ça comme des "micro-Enum"), les constantes en PHP n'ont pas de `$`

- Exemple de `const` :

```php
class ProductController extends AbstractController {

    const int ITEM_PER_PAGE = 15;
    const string VIEW = 'order_view';

    #[Route(path: '', name: 'app_product_index')]
    public function index(ProductRepository $productRepository, Request $request): Response {
        $itemPerPage = $request->query->get('itemPerPage', self::ITEM_PER_PAGE);
        $products = $productRepository->findByLimit($nbItems);

        return $this->renderView('index.html.twig', [
            'products' => $products,
        ]);
    }

}
```

- `static` : se place sur un attribut ou une méthode, il indique que l'élément est propre à la classe, et donc commun à toutes les instances de la classe
  - Pour un attribut, on y accède : `Product::ID` ; si une instance de la classe vient modifier la valeur d'un attribut `static`, alors elle le modifiera pour toutes les autres instances !
  - Pour une méthode, on y accède : `Product::getInstance()`

- Exemple de `static` :

```php
class Product {

    static int $ID = 1;

    private int $id = 0; 

    public function __construct() {
        // Simule l'assignation d'un ID à l'instanciation de la classe
        $this->id = Product::$ID;
        Product::$ID++;
    }

}
```


### Héritage


- Il est présent pour représenter le fait que deux classes ont des comportements similaires
- On parle de classe "parent-enfant"
- Une classe hérite d'une autre classe par l'instruction `extends` :

```php
class A {
    protected int $anAttr;
    private int $aPvAttr;
}

class B extends A {
    private int $myPvAttr
}
```

  - Ici, on dit que B étend de A, donc que B est un A, B est donc une instance de A
  - Pour les attributs, via la relation entre les deux classes :
    - B a accès à l'attribut `$anAttr` de A
    - B n'a pas accès à l'attribut `$aPvAttr` de A
    - A n'a pas accès à l'attribut `$myPvAttr` de B ; **les attributs de B ne sont jamais répercutés dans A** (sauf public...) !

- `override` : c'est le fait de permettre aux enfants de réécrire un comportement (méthode) du parent

```php
class A {
    public function doSomething(): void {
        echo "From the mother !"
    }
}

class B extends A {
    public function doSomething(): void {
        echo "From the child !"
    }
}
```

  - Ici, B a choisit de réécrire le comportement de la classe parente, la méthode `doSomething` redéfinie de l'enfant est priopritaire sur celle de la classe parente !







