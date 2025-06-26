// Rating stars
const stars = document.querySelectorAll('.star');
let selectedRating = 0;

stars.forEach((star, index) => {
  star.addEventListener('mouseover', () => {
    highlightStars(index);
  });

  star.addEventListener('mouseout', () => {
    highlightStars(selectedRating - 1);
  });

  star.addEventListener('click', () => {
    selectedRating = index + 1;
    highlightStars(index);
  });
});

function highlightStars(index) {
  stars.forEach((star, i) => {
    if (i <= index) {
      star.classList.remove('text-gray-400');
      star.classList.add('text-yellow-400');
    } else {
      star.classList.remove('text-yellow-400');
      star.classList.add('text-gray-400');
    }
  });
}

// Sub-service dropdown
document.addEventListener('DOMContentLoaded', () => {
  const serviceSelect = document.getElementById('serviceSelect');
  const subServiceGroup = document.getElementById('subServiceGroup');
  const subServiceSelect = document.getElementById('subServiceSelect');

  const subServices = {
    "web-dev": ["what you get", "Landing Page", "E-Commerce Site", "Portfolio Site", "Custom Web App"],
    "web-design": ["what you get", "UI Design", "UX Design", "Responsive Layout", "Redesign Website"],
    "graphic": ["what you get", "Logo Design", "Social Media Post", "Banner", "Business Card"]
  };

  if (serviceSelect) {
    serviceSelect.addEventListener('change', function () {
      const selected = this.value;

      if (subServices[selected]) {
        subServiceSelect.innerHTML = "";
        subServices[selected].forEach(sub => {
          const option = document.createElement("option");
          option.textContent = sub;
          subServiceSelect.appendChild(option);
        });

        subServiceGroup.classList.remove("hidden");
      } else {
        subServiceGroup.classList.add("hidden");
      }
    });
  }
});

// Save testimonial
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('testimonialForm');
  if (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();

      const name = document.getElementById('name').value.trim();
      const city = document.getElementById('city').value.trim();
      const message = document.getElementById('message').value.trim();
      const rating = selectedRating || 0;

      const testimonial = { name, city, message, rating };

      const testimonials = JSON.parse(localStorage.getItem('testimonials') || '[]');
      testimonials.push(testimonial);
      localStorage.setItem('testimonials', JSON.stringify(testimonials));

      // Redirect after saving
      setTimeout(() => {
        window.location.href = 'submit.html';
      }, 200);
    });
  }

  // Show testimonials if on submit.html
  const container = document.getElementById('testimonialContainer');
  if (container) {
    const testimonials = JSON.parse(localStorage.getItem('testimonials') || '[]');

    testimonials.forEach(({ name, city, message, rating }) => {
      const card = document.createElement('div');
      card.className = 'w-full max-w-xs mx-auto h-80 rounded overflow-hidden hover:transform transition duration-800 hover:scale-105 shadow-lg flex flex-col';

      card.innerHTML = `
        <div class="bg-slate-800 h-1/3 flex flex-col justify-center items-center p-2 rounded-t-2xl">
          <h3 class="text-white font-bold text-lg">${name}</h3>
          <p class="text-white">${city}</p>
           
        </div>
        <div class="bg-gray-400 h-2/3 p-3 text-black flex flex-col item-center rounded-b-2xl overflow-hidden">
         
    <div class="bg-slate-800 text-yellow-400 flex justify-center rounded-2xl"
        <div class="text-yellow-400 mx-auto text-xl justify-center">
            ${'★'.repeat(rating)}${'☆'.repeat(5 - rating)}
          </div>
        <p class="text-sm pt-4">${message}</p>

         
        </div>
      `;

      container.appendChild(card);
    });
  }
});


