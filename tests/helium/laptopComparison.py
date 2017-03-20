from helium.api import *
from time import sleep
from login import loginUser

def main():
    openSite("localhost:8000")
    loginUser("test@email.com", "alpha123STRING")
    click("Laptops")
    click(Button("compare", below="12-inch MacBook Pro"))
    sleep(1)
    click(Button("compare", below="13-inch MacBook Pro"))
    hover("User account")
    click(Text("Compare", below="User account"))
    if(Text("Comparing products").exists() and Text("12-inch MacBook Pro").exists() and Text("13-inch MacBook Pro").exists()):
        print("Test passed!")
    else:
        print("Test failed!")

# loads the given url in chrome and maximizes the window
def openSite(url):
    start_chrome(url)
    get_driver().maximize_window()

# executes the main function when run, not imported.
if __name__ == "__main__":
    main()
