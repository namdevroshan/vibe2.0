const gradients = [
    "ae-gradient-1", "ae-gradient-2", "ae-gradient-3",
    "ae-gradient-4", "ae-gradient-5", "ae-gradient-6"
];

document.querySelectorAll(".e-accordion-item").forEach((item, index) => {
    item.addEventListener("click", function () {
        let isActive = this.classList.contains("active");

        // Remove active class from all items
        document.querySelectorAll(".e-accordion-item").forEach((i) => {
            i.classList.remove("active");
        });

        // Toggle active state
        if (!isActive) {
            this.classList.add("active");
        }

        // Update display panel with smooth zoom-in animation
        let displayPanel = document.getElementById("displayPanel");
        if (displayPanel) {
            let dataContent = this.getAttribute("data-content") || "No content available";

            // Keep panel styling intact but animate content
            let tempDiv = document.createElement("div");
            tempDiv.innerHTML = dataContent;
            tempDiv.style.opacity = "0";
            tempDiv.style.transform = "scale(0.9)";  // Start smaller
            tempDiv.style.transition = "opacity 0.3s ease-out, transform 0.3s ease-out";

            displayPanel.innerHTML = ""; // Clear old content without affecting design
            displayPanel.appendChild(tempDiv);

            setTimeout(() => {
                tempDiv.style.opacity = "1";
                tempDiv.style.transform = "scale(1)"; // Smooth zoom-in effect
            }, 10);

            // Apply gradient
            if (gradients.length > 0) {
                displayPanel.classList.remove(...gradients);
                displayPanel.classList.add(gradients[index % gradients.length]);
            }

            // Apply padding based on screen size
            let screenWidth = parseInt(window.innerWidth, 10);
            if (screenWidth <= 768) { 
                displayPanel.style.padding = "2px 3px";  // Adjusted mobile padding
            } else {
                displayPanel.style.padding = "38px 60px";  // Default padding for larger screens
            }

            // Debugging logs (Remove these after testing)
            console.log("Screen Width:", screenWidth);
            console.log("Applied Padding:", displayPanel.style.padding);
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

        // Apply padding to the cloned panel as well
        clonedPanel.style.padding = "38px 60px";

        item.after(clonedPanel);
    }

    accordionItems.forEach((item) => {
        item.addEventListener("click", function () {
            if (window.innerWidth <= 768) {
                const contentHTML = item.dataset.content; // Get accordion content
                updatePanelPosition(item, contentHTML);
            }
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
                "/Modules/Master-data.html"
            ];
        
            // Select all .u-list-item elements
            const listItems = document.querySelectorAll(".u-section-8 .u-list-item");
        
            // Loop through each .u-list-item and add the link after <p>
            listItems.forEach((item, index) => {
                const paragraph = item.querySelector("p"); // Find the <p> inside the list item
                if (paragraph) {
                    const link = document.createElement("a"); // Create new <a> element
                    link.href = links[index % links.length]; // Assign a different link from the array
                    link.textContent = " Know More"; // Text for the link
                    link.style.color = "#57AEFF"; // Link color
                    link.style.fontWeight = "bold"; // Make it bold
                    link.style.textDecoration = "none"; // Remove underline
        
                    paragraph.appendChild(link); // Append the link inside the paragraph
                }
            });
        });
        
          




