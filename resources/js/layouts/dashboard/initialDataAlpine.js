import updateImageOnChange from '../../utilities/updateImageOnChange.js';

function initialData() {
    function getThemeFromLocalStorage() {
        // if user already changed the theme, use it
        if (window.localStorage.getItem('dark')) {
            return JSON.parse(window.localStorage.getItem('dark'));
        }

        // else return their preferences
        return !!window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    }

    function setThemeToLocalStorage(value) {
        window.localStorage.setItem('dark', value);
    }

    return {
        dark: getThemeFromLocalStorage(),
        isModalOpen: false,
        isNotificationsMenuOpen: false,
        isPagesMenuOpen: false,
        isProfileMenuOpen: false,
        isSideMenuOpen: false,
        trapCleanup: null,

        closeModal() {
            this.isModalOpen = false;
            this.trapCleanup();
        },

        closeNotificationsMenu() {
            this.isNotificationsMenuOpen = false;
        },

        closeProfileMenu() {
            this.isProfileMenuOpen = false;
        },

        closeSideMenu() {
            this.isSideMenuOpen = false;
        },

        openModal() {
            this.isModalOpen = true;
            this.trapCleanup = focusTrap(document.querySelector('#modal'));
        },

        toggleNotificationsMenu() {
            this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen;
        },

        toggleProfileMenu() {
            this.isProfileMenuOpen = !this.isProfileMenuOpen;
        },

        togglePagesMenu() {
            this.isPagesMenuOpen = !this.isPagesMenuOpen;
        },

        toggleSideMenu() {
            this.isSideMenuOpen = !this.isSideMenuOpen;
        },

        toggleTheme() {
            this.dark = !this.dark;
            setThemeToLocalStorage(this.dark);
        },

        updateImageOnChange,
    };
}

export default initialData;
