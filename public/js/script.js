document.addEventListener("DOMContentLoaded", () => {
  const $navbarBurgers = Array.prototype.slice.call(
    document.querySelectorAll(".navbar-burger"),
    0
  );

  // * needed by navbar.php
  if ($navbarBurgers.length) {
    $navbarBurgers.forEach((el) => {
      el.addEventListener("click", () => {
        const target = el.dataset.target;
        const $target = document.getElementById(target);

        el.classList.toggle("is-active");
        $target.classList.toggle("is-active");
      });
    });
  }

  const dropdownIcons = document.querySelectorAll(".dropdown"); // * needed by menu.php
  if (dropdownIcons.length) {
    dropdownIcons.forEach((el) => {
      el.addEventListener("click", () => {
        el.classList.toggle("is-active");
        el.parentElement.children[1].classList.toggle("is-hidden");
      });
    });
  }

  const deleteButtons = document.querySelectorAll(".delete"); // * needed by message.php
  if (deleteButtons.length) {
    deleteButtons.forEach((el) => {
      el.addEventListener("click", () => {
        el.parentElement.classList.toggle("is-hidden");
      });
    });
  }

  const closeModal = document.querySelector(".modal-close"); // * needed by modal.php
  if (closeModal) {
    closeModal.addEventListener("click", () => {
      closeModal.parentElement.classList.toggle("is-active");
    });
  }
});

// * needed by modal.php
function showImage(image = "") {
  document
    .getElementById("modal-image")
    .setAttribute("src", `../../uploads/candidate/${image}`);
  document.querySelector(".modal").classList.toggle("is-active");
}

function hide(id = "") {
  document.getElementById(id).classList.toggle("is-hidden");
}
