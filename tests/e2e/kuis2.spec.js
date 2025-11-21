import { test, expect } from '@playwright/test';

test('Alur login', async ({ page }) => {
  test.setTimeout(60000);

  // 1. Buka landing page
  await page.goto('http://localhost/TOEIC_playwright/public/');
  await page.waitForTimeout(3000);

  // 2. Klik login berdasarkan teks saja
  await page.click('text=Login');
  await page.waitForTimeout(2000);

  // 3. Klik lanjut berdasarkan teks saja  
  await page.click('text=Lanjut');
  await page.waitForTimeout(2000);

  // 4. Isi form
  await page.fill('input[name="username"]', 'admin1');
  await page.fill('input[name="password"]', '12345');
  
  // 5. Submit
  await page.click('button[type="submit"]');
  await page.waitForTimeout(5000);

  // 6. Verifikasi
  const bodyText = await page.textContent('body');
  if (bodyText.includes('Selamat Datang')) {
    console.log('Login BERHASIL!');
  } else {
    await page.screenshot({ path: 'login-failed.png' });
    console.log('Login GAGAL - body text:', bodyText);
  }
});