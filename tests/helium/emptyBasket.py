from helium.api import *
from time import sleep
from addToBasket import addProductToBasket as addToBasket

def main():
    openSite("localhost:8000")
    addToBasket("Laptops", "Acer White", "2")
    addToBasket("Desktops", "iMac", "1")
    addToBasket("Software", "Software Bundle", "1")
    click("Bag")
    click("see bag and proceed")
    while(Text("remove from cart").exists()):
        click("remove from cart")
        sleep(2)
    sleep(3)
    if(Text("Nothing to see here yet").exists()):
        print("Test passed!")
    else:
        print("Test failed!")
    kill_browser()

# loads the given url in chrome and maximizes the window
def openSite(url):
    start_chrome(url)
    get_driver().maximize_window()

# executes the main function when run, not imported.
if __name__ == "__main__":
    main()
