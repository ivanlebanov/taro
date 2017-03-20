from helium.api import *
from login import loginUser

def main():
    openSite("localhost:8000")
    loginUser("test@email.com", "alpha123STRING")
    click("Laptops")
    click(Button("quick buy", below=Text("13-inch MacBook Pro")))
    click("Buy now")
    click(Point(10, 10))
    click("Bag")
    click("See bag and proceed")
    if Text("Bag (£1199)").exists():
        click("Proceed")
        write("0123456789", into="Telephone*")
        click(Button("Save", below=TextField("Postcode*")))
        click("Express (1 day, +£7)")
        click(Button("Save", below=Text("Delivery Methods")))
        click("Place order")
        if Text("Order has been successful").exists():
            print("Test Successful")
        else:
            print("Test Failed")
    else:
        print("Test Failed")


# loads the given url in chrome and maximizes the window
def openSite(url):
    start_chrome(url)
    get_driver().maximize_window()

if __name__ == "__main__":
    main()
