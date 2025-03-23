document.getElementById("start-record").addEventListener("click", function () {
    const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
    recognition.lang = "ar-SA"; // تعيين اللغة العربية

    recognition.onresult = function (event) {
        let transcript = event.results[0][0].transcript;
        console.log("المستخدم قال:", transcript);

        // إرسال البيانات إلى Laravel عبر Ajax
        fetch("/add-expense", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ text: transcript })
        })
        .then(response => response.json())
        .then(data => alert(data.message))
        .catch(error => console.error("خطأ:", error));
    };

    recognition.start();
});
