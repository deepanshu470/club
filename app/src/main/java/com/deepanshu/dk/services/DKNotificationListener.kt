package com.deepanshu.dk.services

import android.service.notification.NotificationListenerService
import android.service.notification.StatusBarNotification

class DKNotificationListener : NotificationListenerService() {

    override fun onNotificationPosted(sbn: StatusBarNotification) {
        val pkg = sbn.packageName
        val text = sbn.notification.extras
            .getCharSequence("android.text")?.toString() ?: return
        // TODO: route to DK brain for processing / auto-reply
        handleIncoming(pkg, text)
    }

    override fun onNotificationRemoved(sbn: StatusBarNotification) {
        // no-op for now
    }

    private fun handleIncoming(packageName: String, text: String) {
        // Placeholder: persist to Room DB or forward to DKMasterService
    }
}
