document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.ajoutpanier').forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            var productId = button.dataset.productId;
            var qteInput = document.getElementById('qte_' + productId);
            var stockCell = document.getElementById('stock_' + productId);

            var qtyToAdd = parseInt(qteInput.value);
            var currentStock = parseInt(stockCell.textContent);

            var updatedStock = currentStock - qtyToAdd;

            if (updatedStock >= 0) {
                stockCell.textContent = updatedStock;
                alert("Produit ajouté au panier !");
            } else {
                alert("La quantité ajoutée au panier dépasse la quantité en stock.");
            }
        });
    });
});
