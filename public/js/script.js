function searchProducts() {
    let input = document.getElementById("searchInput").value.toLowerCase().trim();
    let cards = document.querySelectorAll(".card, .product-card");
    let foundAny = false;

    cards.forEach(card => {
        let heading = card.querySelector("h3, h4");
        if (heading) {
            let name = heading.innerText.toLowerCase();
            if (name.includes(input)) {
                card.style.display = ""; 
                foundAny = true;
            } else {
                card.style.display = "none"; 
            }
        }
    });

    let noProductMessage = document.getElementById("noProductMsg");
    let list = document.getElementById("productList");

    if (!foundAny && input !== "") {
        if (!noProductMessage && list) {
            let msg = document.createElement("h2");
            msg.id = "noProductMsg";
            msg.innerText = "No Product Found 😢";
            msg.style.textAlign = "center";
            msg.style.width = "100%";
            list.appendChild(msg);
        }
    } else {
        if (noProductMessage) noProductMessage.remove();
    }
}