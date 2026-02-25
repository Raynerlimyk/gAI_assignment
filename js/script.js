// Client-side JavaScript functionality

function displayCurrentDateTime() {
    // Get current date and time
    const now = new Date();
    const formattedDateTime = now.toISOString().replace('T', ' ').slice(0, 19);

    // Display the current date and time on the webpage
    document.body.innerHTML = `<h1>Current Date and Time (UTC): ${formattedDateTime}</h1>`;
}

// Call the function to display date and time
window.onload = displayCurrentDateTime;