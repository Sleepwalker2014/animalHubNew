function CookieHandling() {
    return true;
}

CookieHandling.prototype.addCookie = function(key, value) {
    document.cookie = key + "=" + value + "; expires=Thu, 1 Dec 2015 12:00:00 UTC; path=/";
    return true;
};

function ShoppingCart(cookieHandler) {
    this.cookieHandler = cookieHandler;

    return true;
}

ShoppingCart.prototype.addSongToCart = function(song) {
    this.cookieHandler.addCookie('songs', JSON.stringify(this.songs));
    return true;
};