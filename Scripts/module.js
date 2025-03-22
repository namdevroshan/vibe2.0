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
  
  
  