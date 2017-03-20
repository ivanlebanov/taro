from helium.api import *
from time import sleep

def main():
    openSite("localhost:8000")
    click("Desktops")
    addProductToBasket("Desktop", "OfficePC by TARO", "10")
    addProductToBasket("Laptops", "Acer Netbook", "10")
    addProductToBasket("Laptops", "Acer White", "10")
    addProductToBasket("Tablets", "TouchTab", "10")
    addProductToBasket("Software", "Software Bundle", "10")
    click("Bag")
    click("See bag and proceed")

# add quantity of product from category to basket
def addProductToBasket(category, product, quantity):
    click(category)
    click(Text(product).top_left + (20, -30))
    select(ComboBox(to_right_of="Quantity"), quantity)
    sleep(1)
    click("Buy now")
    sleep(1)

# loads the given url in chrome and maximizes the window
def openSite(url):
    start_chrome(url)
    get_driver().maximize_window()

# executes the main function when run, not imported.
if __name__ == "__main__":
    main()
