package com.deepanshu.dk.telecom

import android.telecom.Call
import android.telecom.CallScreeningService

class DKCallHandler : CallScreeningService() {

    override fun onScreenCall(callDetails: Call.Details) {
        // Default: allow all calls through.
        // TODO: check against a block-list stored in Room DB.
        respondToCall(
            callDetails,
            CallResponse.Builder()
                .setDisallowCall(false)
                .setRejectCall(false)
                .build()
        )
    }
}
