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
    } else {
      item.classList.remove('active');
    }
  });
}

// Load components when DOM is ready
document.addEventListener('DOMContentLoaded', async function() {
  // Load sidebar component
  await loadComponent('sidebar-container', 'components/sidebar.html');

  // Load header component
  await loadComponent('header-container', 'components/header.html');

  // Set active menu after components are loaded
  setTimeout(setActiveMenu, 100);

  // Initialize template scripts after components load
  setTimeout(function() {
    // Re-initialize sidebar collapse functionality if needed
    if (typeof feather !== 'undefined') {
      feather.replace();
    }
  }, 200);
});
