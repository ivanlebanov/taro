from helium.api import *

def main():
    openSite("localhost:8000")
    write("McBook", into="Search")
    press(ENTER)
    for name in productNames():
            if("MacBook" not in name.text):
                print("Test failed - unexpected product found")
            else:
                print("Test Successful")
                break
    kill_browser()

# loads the given url in chrome and maximizes the window
def openSite(url):
    start_chrome(url)
    get_driver().maximize_window()

def productNames():
    names = get_driver().find_elements_by_tag_name("h4")
    return names

if __name__ == "__main__":
    main()
