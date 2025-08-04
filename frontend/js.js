document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("contact");

  form.addEventListener("submit", async function (e) {
    e.preventDefault();

    const formData = new FormData(form);
    const data = new URLSearchParams(formData);

    try {
      const response = await fetch("/backend/comentarios.php", {
        method: "POST",
        body: data,
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        }
      });

      const result = await response.text();
      alert(result);
    } catch (error) {
      alert("Erro ao enviar comentário.");
      console.error(error);
    }
  });
});
