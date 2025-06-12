
document.getElementById("submit").addEventListener("submit", function(event) {

    event.preventDefault()

    const formData = new FormData(this)

    fetch("php/submit.php", {
        method: 'POST',
        body: formData
    })

    alert("Successfully Submited")

    window.location.reload()

})


