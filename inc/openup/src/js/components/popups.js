import {Popup} from "./modules";

$('.o-modal').on('click', Popup.closePopupFromOutside.bind(Popup));
$('.o-modal-close').on('click', Popup.closePopup.bind(Popup));

