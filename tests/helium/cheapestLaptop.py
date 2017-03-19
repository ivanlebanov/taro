from helium.api import *

# To verify the correct answer run the following SQL query on the database:
#   "SELECT p_name FROM `product` WHERE category_id='1' ORDER BY `p_price` ASC LIMIT 1"
correctProductName = "Acer Netbook"

def main():
    openSite("localhost:8000")
    click("Laptops")
    select(ComboBox(to_right_of="Laptops"), "Price - low to high")
    if(correctProductName == firstProductName()):
        print("Test Passed!")
    else:
        print("Test Failed!")
    kill_browser()

# loads the given url in chrome and maximizes the window
def openSite(url):
    start_chrome(url)
    get_driver().maximize_window()

def firstProductName():
    names = get_driver().find_elements_by_tag_name("h4")
    firstName = names[0]
    return firstName.text

# executes the main function when run, not imported.
if __name__ == "__main__":
    main()
