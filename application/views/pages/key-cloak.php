<script>
	let initOptions = { 
    //url: 'http://auth.caraga.dswd.gov.ph:8080/auth',
    url: 'https://caraga-auth.dswd.gov.ph:8443/auth', 
    realm: 'entdswd.local', 
    clientId: 'crg-drrmd-svr-apps', 
    onLoad: 'login-required'
}

let keycloak = Keycloak(initOptions);

keycloak.init({ onLoad: initOptions.onLoad, 'checkLoginIframe' : false }).success((auth) => {

    if (!auth) {
        window.location.reload();
    } else {
        console.info("Authenticated");
    }

    //React Render
    //ReactDOM.render(<App />, document.getElementById('root'));

    var tag_id = document.getElementById('root');

    localStorage.setItem('roleAuth', true);
    localStorage.setItem("react-logout", keycloak.createLogoutUrl());
    localStorage.setItem("react-token", keycloak.token);
    localStorage.setItem("react-refresh-token", keycloak.refreshToken);
    localStorage.setItem("react-username", keycloak.idTokenParsed.name);
    localStorage.setItem("react-givenname", keycloak.idTokenParsed.given_name);
    localStorage.setItem("react-familyname", keycloak.idTokenParsed.family_name);
    localStorage.setItem("react-email", keycloak.idTokenParsed.email);
    localStorage.setItem("react-preferred_name", keycloak.idTokenParsed.preferred_username);
    //console.log(keycloak.idTokenParsed);
    //console.log('url' + keycloak.createLogoutUrl());
    setTimeout(() => {
        keycloak.updateToken(70).success((refreshed) => {
            if (refreshed) {
                console.debug('Token refreshed' + refreshed);
            } else {
                console.warn('Token not refreshed, valid for '
                    + Math.round(keycloak.tokenParsed.exp + keycloak.timeSkew - new Date().getTime() / 1000) + ' seconds');
            }
        }).error(() => {
            console.error('Failed to refresh token');
        });


    }, 60000)

}).error(() => {
    console.error("Authenticated Failed");
});
</script>