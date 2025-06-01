function loadPage(page) {
    fetch(`${page}?v=${Date.now()}`)
      .then(response => {
        if (!response.ok) {
          throw new Error("Page not found");
        }
        return response.text();
      })
      .then(data => {
        document.getElementById("main-content").innerHTML = data;
      })
      .catch(error => {
        document.getElementById("main-content").innerHTML = "<p>Failed to load page.</p>";
        console.error(error);
      });
  }
  function handleLogout() {
      if (confirm("Are you sure you want to logout?")) {
          window.location.href = "logout.php";
      }
  }
  function toggleSidebar() {
    const sidebar = document.querySelector(".sidebar-content");
    sidebar.classList.toggle("hidden");
  }
  function upload(){
   }