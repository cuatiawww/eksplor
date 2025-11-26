/**
 * Ruang Yosua - Component Loader
 * Loads reusable sidebar and header components
 */

// Function to load HTML component
async function loadComponent(elementId, componentPath) {
  try {
    const response = await fetch(componentPath);
    if (!response.ok) {
      throw new Error(`Failed to load ${componentPath}: ${response.status}`);
    }
    const html = await response.text();
    const element = document.getElementById(elementId);
    if (element) {
      element.innerHTML = html;
    }
  } catch (error) {
    console.error('Error loading component:', error);
  }
}

// Function to set active menu based on current page
function setActiveMenu() {
  // Get current page name from URL
  const currentPage = window.location.pathname.split('/').pop().replace('.html', '') || 'index';

  // Find all menu items with data-page attribute
  const menuItems = document.querySelectorAll('.pc-navbar .pc-item[data-page]');

  menuItems.forEach(item => {
    const pageName = item.getAttribute('data-page');

    // Add 'active' class if page matches
    if (pageName === currentPage) {
      item.classList.add('active');
      
      // If the active item is inside a dropdown, expand parent dropdown
      const parentDropdown = item.closest('.pc-hasmenu');
      if (parentDropdown) {
        parentDropdown.classList.add('pc-trigger', 'active');
      }
    } else {
      item.classList.remove('active');
    }
  });
}

// Function to initialize dropdown menu functionality
function initDropdownMenu() {
  // Get all menu items with dropdown (pc-hasmenu)
  const dropdownMenus = document.querySelectorAll('.pc-navbar .pc-hasmenu > .pc-link');
  
  dropdownMenus.forEach(menu => {
    menu.addEventListener('click', function(e) {
      e.preventDefault();
      
      const parentItem = this.closest('.pc-hasmenu');
      
      // Toggle active state
      if (parentItem.classList.contains('pc-trigger')) {
        parentItem.classList.remove('pc-trigger');
      } else {
        // Close other open dropdowns
        document.querySelectorAll('.pc-navbar .pc-hasmenu').forEach(item => {
          if (item !== parentItem) {
            item.classList.remove('pc-trigger');
          }
        });
        
        // Open clicked dropdown
        parentItem.classList.add('pc-trigger');
      }
    });
  });
}

// Function to reinitialize template functionality
function reinitializeTemplate() {
  // Re-initialize feather icons
  if (typeof feather !== 'undefined') {
    feather.replace();
  }

  // Re-initialize sidebar collapse/expand
  const sidebarHide = document.getElementById('sidebar-hide');
  const mobileCollapse = document.getElementById('mobile-collapse');
  
  if (sidebarHide) {
    sidebarHide.addEventListener('click', function(e) {
      e.preventDefault();
      document.querySelector('.pc-sidebar').classList.toggle('mob-sidebar-active');
    });
  }

  if (mobileCollapse) {
    mobileCollapse.addEventListener('click', function(e) {
      e.preventDefault();
      document.querySelector('.pc-sidebar').classList.toggle('mob-sidebar-active');
    });
  }

  // Initialize sidebar toggle for desktop
  const pcSidebar = document.querySelector('.pc-sidebar');
  if (pcSidebar) {
    // Check if sidebar should be collapsed on load
    if (window.innerWidth > 1024) {
      // Desktop - sidebar visible by default
      pcSidebar.classList.remove('mob-sidebar-active');
    }
  }
}

// Load components when DOM is ready
document.addEventListener('DOMContentLoaded', async function() {
  // Load sidebar component
  await loadComponent('sidebar-container', 'components/sidebar.html');

  // Load header component
  await loadComponent('header-container', 'components/header.html');

  // Wait for components to render
  setTimeout(function() {
    // Set active menu
    setActiveMenu();
    
    // Initialize dropdown functionality
    initDropdownMenu();
    
    // Reinitialize template scripts
    reinitializeTemplate();
    
    // If pcoded object exists (from pcoded.js), reinitialize it
    if (typeof PcodedConfig !== 'undefined') {
      // Re-run pcoded initialization
      const event = new Event('DOMContentLoaded');
      document.dispatchEvent(event);
    }
  }, 150);
});