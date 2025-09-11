import "./bootstrap";
import "flowbite";
import { initFlowbite } from 'flowbite'; // If you're using ES modules

document.addEventListener('livewire:navigated', () => {
    initFlowbite(); // This will reinitialize all Flowbite components on the page
});
