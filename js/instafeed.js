var token = 'IGQVJXWjZAIQk16TE9OaGRDclBpeDNsck81QXh5bVBvUXNTVkRUTDlRWGhEM2x5dHJkeUJ3TmhKQ29jX0FzeWEzMXRaT1A0MnV2d3ZAzUGZAMRWNjakQ2ZA19UaFQ2WDgzNk55Rlg5YXBnbWNib3BwaDdManV5RHdRRENIcnNZA',
    num_photos = 3, // maximum 20
    container = document.getElementById('gram-container'), // it is our <ul id="rudr_instafeed">
    scrElement = document.createElement('script');

window.mishaProcessResult = function (data) {
    for (x in data.data) {
        container.innerHTML += '<div class="insta-box"><a href="https://www.instagram.com/foxmindgames/" target="_blank"><img src="' + data.data[x].images.low_resolution.url + '"></a></div>';
    }
}

scrElement.setAttribute('src', 'https://api.instagram.com/v1/users/self/media/recent?access_token=' + token + '&count=' + num_photos + '&callback=mishaProcessResult');
document.body.appendChild(scrElement);