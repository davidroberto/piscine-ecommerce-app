<?php


declare(strict_types=1);


class Order
{
    private string $id;
    private string $customerName;
    private string $status;
    private float $totalPrice;
    private array $products;
    private ?string $shippingAddress;

    public function __construct(string $customerName)
    {

        if (mb_strlen($customerName) < 3) {
            throw new Exception('Merci de remplir un nom correct');
        }

        $this->status = 'cart';
        $this->totalPrice = 0;
        $this->customerName = $customerName;
        $this->id = uniqid();
        $this->products = [];
    }

    public function addProduct(): void
    {
        if ($this->status === "cart") {
            $this->products[] = "Pringles";
            $this->totalPrice += 3;
        } else {
            throw new Exception('La commande ne peut pas être modifiée');
        }
    }

    public function removeProduct(): void
    {
        if ($this->status === "cart" && !empty($this->products)) {
            array_pop($this->products);
            $this->totalPrice -= 3;
        }
    }

    public function setShippingAddress(string $shippingAddress): void
    {
        if ($this->status === "cart") {
            $this->shippingAddress = $shippingAddress;
            $this->status = "shippingAddressSet";
        } else {
            throw new Exception('Adresse non modifiable');
        }
    }


    public function pay(): void
    {
        if ($this->status === "shippingAddressSet" && !empty($this->products)) {
            $this->status = "paid";
        } else {
            throw new Exception('Vous ne pouvez pas payer. Soit la commande est déjà payée, soit vous n\'avez pas rempli l\'adresse');
        }

    }

    // private or public


    public function ship(): void
    {
        if ($this->status === 'paid') {
            $this->status = "shipped";
        } else {
            throw new Exception("La commande ne peux pas être expédiée. elle n'est pas encore payée");
        }
    }

    // si je veux lire la valeur des propriétés de mon
    // objet sans les rendre modifiables
    // au lieu de mettre la propriété en public
    // je peux créer une méthode public qui retourne
    // la valeur de la propriété, sans me permettre de la modifier

    public function getId(): string {
        return $this->id;
    }

    public function getProducts(): array {
        return $this->products;
    }

    public function getAddress(): string {
        return $this->shippingAddress;
    }
}

