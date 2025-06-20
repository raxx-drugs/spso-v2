class PageTransition {
    constructor() {
        this.transitionElement = document.getElementById('pageTransition');
        this.isTransitioning = false;
        this.transitionSpeed = 400; // ms - should match CSS --transition-speed
        this.init();
    }

    init() {
        // Initialize hexagon grid if container exists
        this.initHexagonGrid();
        
        // Set up navigation handlers
        this.setupNavigation();
        
        // Hide transition when page loads
        window.addEventListener('load', () => this.hideTransition());
    }

    initHexagonGrid() {
        const HEXAGON_CONFIG = {
            pattern: [1, 2, 3],
            names: [
                ["Employee Portal"], 
                ["Request", "Attendance"],
                ["Accomplished", "Inventory", "Installers"]
            ],
            icons: [
                ["bi-person-circle"], 
                ["bi-file-earmark-text", "bi-calendar-check"],
                ["bi-clipboard-check", "bi-box", "bi-tools"]
            ]
        };

        const container = document.getElementById('hexagonGrid');
        if (!container) return;

        container.innerHTML = '';
        
        HEXAGON_CONFIG.pattern.forEach((rowCount, rowIndex) => {
            const row = this.createHexagonRow();
            
            for (let colIndex = 0; colIndex < rowCount; colIndex++) {
                const hexagon = this.createHexagon(
                    HEXAGON_CONFIG.names[rowIndex][colIndex],
                    HEXAGON_CONFIG.icons[rowIndex][colIndex]
                );
                row.appendChild(hexagon);
            }
            
            container.appendChild(row);
        });
    }

    createHexagonRow() {
        const row = document.createElement('div');
        row.classList.add('hexagon-row');
        return row;
    }
    
    createHexagon(name, iconClass) {
        const item = document.createElement('div');
        item.classList.add('hexagon-item');

        const hexagon = document.createElement('div');
        hexagon.classList.add('hexagon');

        const icon = document.createElement('i');
        icon.classList.add('bi', iconClass);

        const text = document.createElement('span');
        text.classList.add('hexagon-text');
        text.textContent = name;

        // Add click event listener to hexagon
        hexagon.addEventListener('click', () => {
            const routes = {
                "Employee Portal": "/test/employee-portal",
                "Request": "/test/request",
                "Attendance": "/test/attendance",
                "Accomplished": "/test/accomplished",
                "Inventory": "/test/inventory",
                "Installers": "/test/installers"
            };
        
            if (routes[name]) {
                this.navigateTo(routes[name]);
            } else {
                alert(`Clicked: ${name}`);
            }
        });
        
        // Append icon and text to hexagon
        hexagon.appendChild(icon);
        hexagon.appendChild(text);
        item.appendChild(hexagon);

        return item;
    }

    // Set up navigation for all links
    setupNavigation() {
        document.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', (e) => {
                const href = link.getAttribute('href');
                
                if (this.shouldInterceptClick(href, link)) {
                    e.preventDefault();
                    this.navigateTo(href);
                }
            });
        });
    }

    shouldInterceptClick(href, link) {
        return href && 
               href.startsWith('/') && 
               !href.startsWith('#') && 
               !link.hasAttribute('target') && 
               !link.hasAttribute('download') &&
               !link.classList.contains('no-transition');
    }

    navigateTo(url) {
        if (this.isTransitioning) return;
        this.isTransitioning = true;
        
        // Show transition
        this.showTransition();
        
        // Wait for transition to complete before navigating
        setTimeout(() => {
            window.location.href = url;
        }, this.transitionSpeed);
    }

    showTransition() {
        this.transitionElement.classList.add('active');
        document.body.classList.add('no-scroll');
    }

    hideTransition() {
        setTimeout(() => {
            this.transitionElement.classList.remove('active');
            document.body.classList.remove('no-scroll');
            this.isTransitioning = false;
        }, 100);
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new PageTransition();
});