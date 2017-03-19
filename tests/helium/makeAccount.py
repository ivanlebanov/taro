from helium.api import *

# This test creates a new account on the system. So before running, requires the
# test user to be manually removed from the database if the test has been run previously.

def main():
    openSite("localhost:8000")
    click("Login / Register")
    click("Don't have an account? Register")
    fillForm()
    click("Register")
    if (not (Text("The following errors have occurred:").exists())):
        print("Test passed!")
    else:
        print("Test failed!")
        print("Ensure that the database doesnt already contain the test data.")
    kill_browser()

# loads the given url in chrome and maximizes the window
def openSite(url):
    start_chrome(url)
    get_driver().maximize_window()

def fillForm():
    write("testaccount", into="Name")
    write("test@email.com", into="Email")
    write("alpha123STRING", into="Password")
    write("alpha123STRING", into="Confirm password")

# executes the main function when run, not imported.
if __name__ == "__main__":
    main()
