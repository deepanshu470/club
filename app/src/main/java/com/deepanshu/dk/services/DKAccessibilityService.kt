package com.deepanshu.dk.services

import android.accessibilityservice.AccessibilityService
import android.view.accessibility.AccessibilityEvent

class DKAccessibilityService : AccessibilityService() {

    override fun onAccessibilityEvent(event: AccessibilityEvent) {
        // Placeholder: inspect UI events for automation / click-through
    }

    override fun onInterrupt() {
        // Service interrupted
    }
}
