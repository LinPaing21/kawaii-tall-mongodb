// Simple Exam Attempt Tracker
class ExamTracker {
  constructor() {
    this.storageKey = "kawaii_exam_attempts"
    this.maxFreeAttempts = 3
  }

  // Get current attempt count
  getAttemptCount() {
    const stored = localStorage.getItem(this.storageKey)
    return stored ? Number.parseInt(stored) : 0
  }

  // Add one attempt
  addAttempt() {
    const current = this.getAttemptCount()
    const newCount = current + 1
    localStorage.setItem(this.storageKey, newCount.toString())
    return newCount
  }

  // Check if exceeded free attempts
  hasExceededFreeAttempts() {
    return this.getAttemptCount() >= this.maxFreeAttempts
  }

  // Get remaining attempts
  getRemainingAttempts() {
    return Math.max(0, this.maxFreeAttempts - this.getAttemptCount())
  }

  // Show the login suggestion modal
  showLoginSuggestion() {
    const modal = document.getElementById("loginSuggestionModal")
    if (modal) {
      modal.classList.remove("hidden")
      document.body.style.overflow = "hidden"
    }
  }

  // Close the modal
  closeLoginSuggestion() {
    const modal = document.getElementById("loginSuggestionModal")
    if (modal) {
      modal.classList.add("hidden")
      document.body.style.overflow = "auto"
    }
  }

  // Show banner with remaining attempts
  showAttemptBanner() {
    const remaining = this.getRemainingAttempts()
    const current = this.getAttemptCount()
    const banner = document.getElementById("attemptBanner")

    // Only show if user has taken at least 1 test and has attempts left
    if (banner && current > 0 && remaining > 0) {
      banner.innerHTML = `
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
          <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2">
              <span class="text-blue-600">ℹ️</span>
              <span class="text-sm text-blue-800">
                Free trial: <strong>${remaining} practice test${remaining !== 1 ? "s" : ""}</strong> remaining
              </span>
            </div>
            <a href="{{ route('register') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-1 rounded transition-colors">
              Sign Up Free
            </a>
          </div>
        </div>
      `
      banner.classList.remove("hidden")
    }
  }

  // Handle when user completes an exam
  onExamComplete() {
    console.log("Exam completed. Tracking attempt...")
    // Only track for guests (non-authenticated users)
    if (!window.isAuthenticated && !sessionStorage.getItem("alreadyShowed")) {
      sessionStorage.setItem("alreadyShowed", true)

      const newCount = this.addAttempt()
      console.log(`Exam completed. Total attempts: ${newCount}`)

      // Show login suggestion if they've used all free attempts
      if (newCount >= this.maxFreeAttempts) {
        setTimeout(() => {
          this.showLoginSuggestion()
        }, 1500) // Wait 1.5 seconds after results show
      }
    }
  }

  // Reset attempts (for testing)
  reset() {
    localStorage.removeItem(this.storageKey)
    console.log("Exam attempts reset")
  }
}

// Create global instance
window.examTracker = new ExamTracker()

console.log("ExamTracker initialized")

// Global functions
window.closeLoginSuggestion = function () {
  window.examTracker.closeLoginSuggestion()
}

window.resetExamAttempts = function () {
  window.examTracker.reset()
  location.reload()
}
