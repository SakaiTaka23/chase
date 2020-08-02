let place = document.querySelector('[name="place"]');
let place_s = document.querySelector('[name="place_s"]');
place.value = place_s.value;
place_s.onchange = () =>
{
    place.value = place_s.value;
}