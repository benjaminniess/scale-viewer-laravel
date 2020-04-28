/**
 * The Google connect button
 */
$('#google-connect-button').click(function(e) {
    e.preventDefault();
    e.stopPropagation();

    // Call the Firbase frontend login system + send result to PHP via ajax
    firebase.auth().signInWithPopup(provider).then(function(data) {
        $.ajax({
            url: "/google-connect?accessToken=" + data.credential.accessToken
        }).done(function() {
            window.location.replace("/");
        })
    });
})

// Initialize Firebase on the login page
if (typeof firebaseConfig !== 'undefined') {
    firebase.initializeApp(firebaseConfig);

    var provider = new firebase.auth.GoogleAuthProvider();
    provider.addScope('profile');
    provider.addScope('email');
    provider.addScope('https://www.googleapis.com/auth/plus.me');
}

