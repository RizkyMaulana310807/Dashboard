    // Function to apply the dark mode based on the user's system preference
    function applyDarkMode() {
        const darkModeMediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
        const isDarkMode = darkModeMediaQuery.matches;

        // Apply dark mode if the user's system preference is dark
        if (isDarkMode) {
            document.body.classList.add('dark');
        } else {
            document.body.classList.remove('dark');
        }
    }

    // Apply dark mode on initial load
    applyDarkMode();

    // Optional: Add a listener to handle changes in the user's system theme preference
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        if (e.matches) {
            document.body.classList.add('dark');
        } else {
            document.body.classList.remove('dark');
        }
    });
