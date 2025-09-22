/**
 * Global Theme System for Usceligin Platform
 * Supports: System preference detection + Manual toggle + Persistence
 * Works on: Pages with toggle buttons + Pages without toggle buttons
 *
 * Usage:
 * - Automatic initialization on page load
 * - Manual toggle via ThemeSystem.toggle()
 * - System preference detection
 * - LocalStorage persistence
 *
 * @author Claude Code
 * @version 1.0.0
 */

class ThemeSystem {
  constructor() {
    this.STORAGE_KEY = 'usceligin-theme';
    this.THEME_ATTRIBUTE = 'data-theme';
    this.THEMES = {
      LIGHT: 'light',
      DARK: 'dark'
    };

    // Initialize theme system
    this.init();
  }

  /**
   * Initialize the theme system
   * 1. Detect system preference
   * 2. Check for saved preference
   * 3. Apply theme
   * 4. Set up listeners
   */
  init() {
    const theme = this.getInitialTheme();
    this.applyTheme(theme);
    this.setupSystemPreferenceListener();
    this.setupToggleButtons();

    // Dispatch custom event for other components
    this.dispatchThemeEvent('init', theme);
  }

  /**
   * Get initial theme based on priority:
   * 1. Saved user preference (localStorage)
   * 2. System preference (prefers-color-scheme)
   * 3. Default to light
   */
  getInitialTheme() {
    // Check for saved preference first
    const savedTheme = localStorage.getItem(this.STORAGE_KEY);
    if (savedTheme && Object.values(this.THEMES).includes(savedTheme)) {
      return savedTheme;
    }

    // Check system preference
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
      return this.THEMES.DARK;
    }

    // Default to light
    return this.THEMES.LIGHT;
  }

  /**
   * Get current active theme
   */
  getCurrentTheme() {
    return document.documentElement.getAttribute(this.THEME_ATTRIBUTE) || this.THEMES.LIGHT;
  }

  /**
   * Apply theme to document
   * @param {string} theme - 'light' or 'dark'
   */
  applyTheme(theme) {
    const root = document.documentElement;

    if (theme === this.THEMES.DARK) {
      root.setAttribute(this.THEME_ATTRIBUTE, this.THEMES.DARK);
    } else {
      root.removeAttribute(this.THEME_ATTRIBUTE);
    }

    // Save to localStorage
    localStorage.setItem(this.STORAGE_KEY, theme);

    // Update toggle buttons if they exist
    this.updateToggleButtons(theme);

    // Dispatch theme change event
    this.dispatchThemeEvent('change', theme);
  }

  /**
   * Toggle between light and dark theme
   */
  toggle() {
    const currentTheme = this.getCurrentTheme();
    const newTheme = currentTheme === this.THEMES.DARK ? this.THEMES.LIGHT : this.THEMES.DARK;
    this.applyTheme(newTheme);
    return newTheme;
  }

  /**
   * Set specific theme
   * @param {string} theme - 'light' or 'dark'
   */
  setTheme(theme) {
    if (Object.values(this.THEMES).includes(theme)) {
      this.applyTheme(theme);
    } else {
      console.warn(`Invalid theme: ${theme}. Use 'light' or 'dark'.`);
    }
  }

  /**
   * Listen for system preference changes
   */
  setupSystemPreferenceListener() {
    if (window.matchMedia) {
      const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');

      mediaQuery.addEventListener('change', (e) => {
        // Only auto-switch if user hasn't manually set a preference
        const savedTheme = localStorage.getItem(this.STORAGE_KEY);
        if (!savedTheme) {
          const systemTheme = e.matches ? this.THEMES.DARK : this.THEMES.LIGHT;
          this.applyTheme(systemTheme);
        }
      });
    }
  }

  /**
   * Set up toggle buttons (if they exist on the page)
   */
  setupToggleButtons() {
    // Look for common theme toggle selectors
    const toggleSelectors = [
      '[data-theme-toggle]',
      '.theme-toggle',
      '#theme-toggle',
      '.dark-mode-toggle',
      '[aria-label*="theme" i]',
      '[aria-label*="dark" i]'
    ];

    toggleSelectors.forEach(selector => {
      const toggles = document.querySelectorAll(selector);
      toggles.forEach(toggle => {
        toggle.addEventListener('click', (e) => {
          e.preventDefault();
          this.toggle();
        });
      });
    });
  }

  /**
   * Update toggle button states
   * @param {string} theme - Current theme
   */
  updateToggleButtons(theme) {
    const toggles = document.querySelectorAll('[data-theme-toggle], .theme-toggle, #theme-toggle');

    toggles.forEach(toggle => {
      // Update aria attributes for accessibility
      toggle.setAttribute('aria-pressed', theme === this.THEMES.DARK);

      // Update text content if it contains theme info
      if (toggle.textContent) {
        if (theme === this.THEMES.DARK) {
          toggle.textContent = toggle.textContent.replace(/🌞|☀️|light/gi, '🌙');
        } else {
          toggle.textContent = toggle.textContent.replace(/🌙|🌛|dark/gi, '🌞');
        }
      }

      // Update classes for styling
      toggle.classList.toggle('dark-mode', theme === this.THEMES.DARK);
      toggle.classList.toggle('light-mode', theme === this.THEMES.LIGHT);
    });
  }

  /**
   * Dispatch custom theme events
   * @param {string} type - Event type ('init', 'change')
   * @param {string} theme - Current theme
   */
  dispatchThemeEvent(type, theme) {
    const event = new CustomEvent(`theme-${type}`, {
      detail: {
        theme: theme,
        isDark: theme === this.THEMES.DARK,
        isLight: theme === this.THEMES.LIGHT,
        timestamp: Date.now()
      }
    });

    document.dispatchEvent(event);
  }

  /**
   * Get theme info for other components
   */
  getThemeInfo() {
    const currentTheme = this.getCurrentTheme();
    return {
      theme: currentTheme,
      isDark: currentTheme === this.THEMES.DARK,
      isLight: currentTheme === this.THEMES.LIGHT,
      systemPrefersDark: window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches,
      hasStoredPreference: !!localStorage.getItem(this.STORAGE_KEY)
    };
  }

  /**
   * Reset to system preference
   */
  resetToSystem() {
    localStorage.removeItem(this.STORAGE_KEY);
    const systemTheme = (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)
      ? this.THEMES.DARK
      : this.THEMES.LIGHT;
    this.applyTheme(systemTheme);
  }

  /**
   * Debug info for development
   */
  debug() {
    console.log('Theme System Debug Info:', {
      current: this.getCurrentTheme(),
      stored: localStorage.getItem(this.STORAGE_KEY),
      system: window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light',
      toggleButtons: document.querySelectorAll('[data-theme-toggle], .theme-toggle, #theme-toggle').length,
      info: this.getThemeInfo()
    });
  }
}

// Initialize global theme system
window.ThemeSystem = new ThemeSystem();

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
  module.exports = ThemeSystem;
}

// Expose utility functions globally
window.toggleTheme = () => window.ThemeSystem.toggle();
window.setTheme = (theme) => window.ThemeSystem.setTheme(theme);
window.getThemeInfo = () => window.ThemeSystem.getThemeInfo();

// Development helper
if (process.env.NODE_ENV === 'development') {
  window.debugTheme = () => window.ThemeSystem.debug();
}

/**
 * Usage Examples:
 *
 * // Automatic initialization (happens on page load)
 * // No code needed - theme is automatically applied
 *
 * // Manual toggle (for toggle buttons)
 * ThemeSystem.toggle();
 *
 * // Set specific theme
 * ThemeSystem.setTheme('dark');
 *
 * // Listen for theme changes
 * document.addEventListener('theme-change', (e) => {
 *   console.log('Theme changed to:', e.detail.theme);
 * });
 *
 * // Get current theme info
 * const themeInfo = ThemeSystem.getThemeInfo();
 * console.log(themeInfo.isDark); // true/false
 *
 * // Reset to system preference
 * ThemeSystem.resetToSystem();
 */