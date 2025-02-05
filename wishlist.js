document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".remove-wishlist-btn").forEach(button => {
        button.addEventListener("click", function() {
            let productId = this.getAttribute("data-product-id");
            let wishlistItem = this.closest(".wishlist-item");

            fetch("remove_from_wishlist.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `product_id=${productId}`
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.status === "success") {
                    wishlistItem.remove(); // Remove the item from the UI
                }
            })
            .catch(error => console.error("Error:", error));
        });
    });
});
