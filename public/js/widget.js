document.addEventListener("DOMContentLoaded", function () {
    const apiKey = document
        .querySelector("[data-api-key]")
        .getAttribute("data-api-key");
    const button = document.getElementById("sendRequestButton");
    var csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    async function sendRequest(data) {
        try {
            const response = await fetch(
                "http://localhost:8000/api/save-record",
                {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                        Authorization: `Bearer ${apiKey}`,
                    },
                    body: JSON.stringify(data),
                }
            );

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const result = await response.json();
            console.log("Success:", result);
        } catch (error) {
            console.error("Error:", error);
        }
    }

    // Wywołanie funkcji na kliknięcie przycisku
    button.addEventListener("click", function () {
        // Wysłanie danych z polem "data"
        sendRequest({ data: `${location.host}` });
    });
});
