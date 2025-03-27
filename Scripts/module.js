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

            // Apply the required padding when an item is clicked
            displayPanel.style.padding = "38px 60px";
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
document.addEventListener("DOMContentLoaded", function () {
    const accordionItems = document.querySelectorAll(".e-accordion-item");
    const displayPanel = document.querySelector(".e-display-panel");

    function updatePanelPosition(item, contentHTML) {
        // Remove existing panels
        document.querySelectorAll(".e-display-panel").forEach(panel => panel.remove());

        // Clone display panel and insert below the clicked item
        const clonedPanel = displayPanel.cloneNode(true);
        clonedPanel.style.display = "block";

        // Remove highlighted text from cloned panel (for mobile)
        clonedPanel.innerHTML = contentHTML.replace(/<span class=['"]highlight['"]>(.*?)<\/span>/g, "$1");

        // Apply different padding based on screen size
        if (window.innerWidth <= 768) {
            clonedPanel.style.padding = "20px 20px"; // Reduced padding for mobile
        } else {
            clonedPanel.style.padding = "38px 60px"; // Default padding for larger screens
        }

        item.after(clonedPanel);
    }

    accordionItems.forEach((item) => {
        item.addEventListener("click", function () {
            const contentHTML = item.dataset.content; // Get accordion content
            updatePanelPosition(item, contentHTML);
        });
    });
});








const menuToggle = document.querySelector('.hamburger-menu');
        const nav = document.querySelector('.nav-links');

        menuToggle.addEventListener('click', function() {
            nav.classList.toggle('active');
            menuToggle.classList.toggle('active');
            menuToggle.textContent = nav.classList.contains('active') ? '✖' : '☰';
        });




        document.addEventListener("DOMContentLoaded", function () {
            // List of different links for each .u-list-item
            const links = [
                "/Modules/Data-extract.html",
                "/Modules/Data-transform.html",
                "/Modules/Data-model.html",
                "/Modules/Data-workflow.html",
                "/Modules/Master-date.html"
            ];
        
            // Select all .u-list-item elements
            const listItems = document.querySelectorAll(".u-section-13 .u-list-item");
        
            // Loop through each .u-list-item and add the link after <p>
            listItems.forEach((item, index) => {
                const paragraph = item.querySelector("p"); // Find the <p> inside the list item
                if (paragraph) {
                    const link = document.createElement("a"); // Create new <a> element
                    link.href = links[index % links.length]; // Assign a different link from the array
                    link.textContent = " Read More"; // Text for the link
                    link.style.color = "#57AEFF"; // Link color
                    link.style.fontWeight = "bold"; // Make it bold
                    link.style.textDecoration = "none"; // Remove underline
        
                    paragraph.appendChild(link); // Append the link inside the paragraph
                }
            });
        });
        
          