const notifications = document.querySelector(".notifications");

const toastDetails = {
  timer: 5000,
  success: {
    icon: "fa-check-circle-o",
    text: "ورود شما با موفقیت انجام شد",
  },
  successregister: {
    icon: "fa-check-circle-o",
    text: "ثبت نام شما با موفقیت انجام شد",
  },
  successinputnumber: {
    icon: "fa-check-circle-o",
    text: "رمز یکبار مصرف با موفقیت ارسال شد",
  },
  errorinputnumber: {
    icon: "fa-times-circle-o",
    text: "این شماره قبلا در سامانه ثبت نشده است",
  },
  error: {
    icon: "fa-times-circle-o",
    text: "لطفا در وارد کردن اطلاعات دقت نمایید",
  },
};
const removeToast = (toast) => {
  toast.classList.add("hide");
  if (toast.timeoutId) clearTimeout(toast.timeoutId);
  setTimeout(() => toast.remove(), 500);
};

const createToast = (id) => {
  console,console.log(id);
  
  const { icon, text } = toastDetails[id];
  const toast = document.createElement("li");
  toast.className = `toast ${id}`;
  toast.innerHTML = `<div class="column">
                         <span>${text}</span>
                         <i class="fa ${icon}"></i>
                      </div>
                      <i class="fa-solid fa-xmark" onclick="removeToast(this.parentElement)"></i>`;
  notifications.appendChild(toast);
  toast.timeoutId = setTimeout(() => removeToast(toast), toastDetails.timer);
};

//برای دریافت حالت نمایش تست با استفاده از کوئری استرینگ
const params = new Proxy(new URLSearchParams(window.location.search), {
  get: (searchParams, prop) => searchParams.get(prop),
});

let value = params.status;
if(value){
  createToast(value);
}

/* ---------------------------------------------------------- */

const container = document.getElementById("container");
const registerBtn = document.getElementById("register");
const loginBtn = document.getElementById("login");

registerBtn.addEventListener("click", () => {
  container.classList.add("active");
});

loginBtn.addEventListener("click", () => {
  container.classList.remove("active");
});

