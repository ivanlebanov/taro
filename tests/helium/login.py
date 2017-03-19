from helium.api import *

def main():
    openSite("localhost:8000")
    loginUser("test@email.com", "alpha123STRING")
    if (not (Text("The following errors have occurred:").exists())):
        print("Test passed!")
    else:
        print("Test failed!")
    kill_browser()

def loginUser(email, password):
    click("Login / Register")
    write(email, into="E-mail")
    write(password, into="Password")
    click("Login")

# loads the given url in chrome and maximizes the window
def openSite(url):
    start_chrome(url)
    get_driver().maximize_window()

# executes the main function when run, not imported.
if __name__ == "__main__":
    main()
