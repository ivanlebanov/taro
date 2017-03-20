from helium.api import *
from time import sleep
from login import loginUser

prod1 = "12-inch MacBook Pro"
prod2 = "13-inch MacBook Pro"

def main():
    openSite("localhost:8000")
    loginUser("test@email.com", "alpha123STRING")
    click("Laptops")
    click(Button("compare", below=prod1))
    sleep(1)
    click(Button("compare", below=prod2))
    hover("User account")
    click(Text("Compare", below="User account"))
    if(Text("Comparing products").exists() and Text(prod1).exists() and Text(prod2).exists()):
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
