import { test, expect } from '@playwright/test';

test('has title', async ({ page }) => {
  await page.goto('http://localhost/TOEIC_playwright/public/');

  // Expect a title "to contain" a substring.
  await expect(page).toHaveTitle(/TOEIC/);
});

test('login link navigation', async ({ page }) => {
  await page.goto('http://localhost/TOEIC_playwright/public/');

  // Click the login link
  await page.getByRole('link', { name: 'Login' }).click();

  // Expects page to have a heading with the name of login
  await expect(page.getByRole('heading', { name: 'Selamat Datang' })).toBeVisible();
});