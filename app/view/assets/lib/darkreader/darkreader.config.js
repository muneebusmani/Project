  // Get the toggle button element
  const toggleButton = document.getElementById('toggleDarkMode');

  // Check if Dark Mode is enabled in localStorage
  const isDarkModeEnabled = localStorage.getItem('darkModeEnabled') === 'true';

  // Set the initial state of the toggle button
  toggleButton.checked = isDarkModeEnabled;
  if (isDarkModeEnabled) {
    toggleButton.parentNode.classList.add('on');
    enableDarkMode();
  }

  // Add event listener to the toggle button
  toggleButton.addEventListener('change', toggleDarkMode);

  // Function to enable Dark Mode
  function enableDarkMode() {
    DarkReader.enable({
      brightness: 100,
      contrast: 100,
      sepia: 0
    });
  }

  // Function to disable Dark Mode
  function disableDarkMode() {
    DarkReader.disable();
  }

  // Function to toggle Dark Mode
  function toggleDarkMode() {
    // Check if Dark Mode is currently enabled
    const isEnabled = toggleButton.checked;

    // Update the localStorage state
    localStorage.setItem('darkModeEnabled', isEnabled);

    // If enabled, enable Dark Mode with custom settings
    // If disabled, disable Dark Mode
    if (isEnabled) {
      enableDarkMode();
      toggleButton.parentNode.classList.add('on');
    } else {
      disableDarkMode();
      toggleButton.parentNode.classList.remove('on');
    }
  }