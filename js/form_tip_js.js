(function() {
    let form = document.getElementById('form');
    let result = document.getElementById('result');

    console.log('Yes');
    form.addEventListener('submit', function(event) {
        console.log('Yes, into');
        let tip = document.getElementById('tip');

        let searchParams = new URLSearchParams('tip=' + tip.value);
        let promise = fetch('./php/ajax.php', {
            method: 'POST',
            body: searchParams
        })

        promise.then(response => {
            return response.text();
        }).then(text => {
            result.innerHTML = text;
        })

        event.preventDefault();
    });
}());