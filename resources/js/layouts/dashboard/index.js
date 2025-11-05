import '../../components/input/time/index.js';

import '../../utilities/isBlobable.js';
import '../../utilities/toBlob.js';
import '../../utilities/toDataURL.js';
import Alpine from 'alpinejs';
import initialData from './initialDataAlpine.js';

window.Alpine = Alpine;

Alpine.data('initialData', initialData);
Alpine.start();
