import {test, expect} from '@playwright/test';

// test('Halaman utama sistem TOEIC', async ({ page }) => {
//   await page.goto('http://localhost/TOEIC_playwright/public/');

//   // Expect a title "to contain" a substring.
//   await expect(page).toHaveTitle(/TOEIC/);
// });

test("login sebagai admin, kemudian GET halaman login", async ({ page }) => {
  const url = "http://localhost/TOEIC_playwright/public/";

  // Buka halaman login
  await page.goto(url + "/login/");
  console.log("Buka halaman login");
  await page.click('button, button:has-text("Lanjut")');

  // Isi form login
  console.log("Isi form login");
  await page.fill('input[name="username"]', 'admin1');
  await page.fill('input[name="password"]', '12345');
  await page.click('button[type="submit"], button:has-text("Login")');

  // menunggu sampai input username muncul
  await page.waitForSelector('input[name="username"]', {timeout: 20000});

  // Tunggu tanda bahwa login sukses (misalnya dashboard, navbar, dll)
  try {
    await page.waitForSelector("nav, .dashboard, .home-page", {
      timeout: 8000,
    });
    console.log("Login berhasil, dashboard ditemukan!");
  } catch {
    console.log(
      "Tidak menemukan elemen dashboard, tapi test tetap dilanjutkan."
    );
  }
  
  const currentUrl = await page.url();
  console.log("URL setelah proses login:", currentUrl);
  
  // Anggap berhasil kalau tidak tetap di /login
  expect(currentUrl.includes("/login")).toBeFalsy();
});