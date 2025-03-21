const gradients = ["ae-gradient-1", "ae-gradient-2", "ae-gradient-3", "ae-gradient-4"];

document.querySelectorAll(".e-accordion-item").forEach((item, index) => {
    item.addEventListener("click", function () {
        let content = this.querySelector(".e-accordion-content");
        let isActive = this.classList.contains("active");

        // Remove active class from all items and hide content
        document.querySelectorAll(".e-accordion-item").forEach((i) => {
            i.classList.remove("active");
            let iContent = i.querySelector(".e-accordion-content");
            if (iContent) {
                iContent.classList.remove("active");
                iContent.classList.remove("slide-right");
            }
        });

        // Toggle active state
        if (!isActive) {
            this.classList.add("active");
            if (content) {
                content.classList.add("active");
                content.classList.add("slide-right");
            }
        }

        // Update display panel
        let displayPanel = document.getElementById("displayPanel");
        if (displayPanel) {
            displayPanel.innerHTML = this.getAttribute("data-content"); // Fixed attribute name
            displayPanel.classList.remove(...gradients);
            displayPanel.classList.add(gradients[index % gradients.length]);
        }
    });
});

document.querySelectorAll(".e-accordion-item").forEach((item) => {
    item.addEventListener("click", function () {
        // Remove active class from all items
        document.querySelectorAll(".e-accordion-item").forEach((i) => {
            i.classList.remove("active");
        });

        // Add active class to the clicked item
        this.classList.add("active");
    });
});
