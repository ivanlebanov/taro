from helium.api import *
from login import loginUser

def main():
    openSite("localhost:8000")
    loginUser("test@email.com", "alpha123STRING")
    click("Logout")
    if (Text("Login / Register").exists()):
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
