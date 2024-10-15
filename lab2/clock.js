function updateClock() {
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    
    const day = String(now.getDate()).padStart(2, '0');
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const year = now.getFullYear();

    const clockDisplay = document.getElementById('clock');
    clockDisplay.textContent = `Data: ${day}-${month}-${year} | ${hours}:${minutes}:${seconds}`;
}

setInterval(updateClock, 1000);
updateClock();
