
var JSEncryptExports = {}; (function(bC) {
    var aK;
    var d = 244837814094590;
    var Y = ((d & 16777215) == 15715070);
    function O(z, t, L) {
        if (z != null) {
            if ("number" == typeof z) {
                this.fromNumber(z, t, L)
            } else {
                if (t == null && "string" != typeof z) {
                    this.fromString(z, 256)
                } else {
                    this.fromString(z, t)
                }
            }
        }
    }
    function ai() {
        return new O(null)
    }
    function bO(bV, L, bW, bT, t, z) {
        while (--z >= 0) {
            var bU = L * this[bV++] + bW[bT] + t;
            t = Math.floor(bU / 67108864);
            bW[bT++] = bU & 67108863
        }
        return t
    }
    function l(bZ, bT, bU, bX, L, bV) {
        var t = bT & 32767,
        z = bT >> 15;
        while (--bV >= 0) {
            var bW = this[bZ] & 32767;
            var b0 = this[bZ++] >> 15;
            var bY = z * bW + b0 * t;
            bW = t * bW + ((bY & 32767) << 15) + bU[bX] + (L & 1073741823);
            L = (bW >>> 30) + (bY >>> 15) + z * b0 + (L >>> 30);
            bU[bX++] = bW & 1073741823
        }
        return L
    }
    function aQ(bZ, bT, bU, bX, L, bV) {
        var t = bT & 16383,
        z = bT >> 14;
        while (--bV >= 0) {
            var bW = this[bZ] & 16383;
            var b0 = this[bZ++] >> 14;
            var bY = z * bW + b0 * t;
            bW = t * bW + ((bY & 16383) << 14) + bU[bX] + L;
            L = (bW >> 28) + (bY >> 14) + z * b0;
            bU[bX++] = bW & 268435455
        }
        return L
    }
    if (Y && (navigator.appName == "Microsoft Internet Explorer")) {
        O.prototype.am = l;
        aK = 30
    } else {
        if (Y && (navigator.appName != "Netscape")) {
            O.prototype.am = bO;
            aK = 26
        } else {
            O.prototype.am = aQ;
            aK = 28
        }
    }
    O.prototype.DB = aK;
    O.prototype.DM = ((1 << aK) - 1);
    O.prototype.DV = (1 << aK);
    var bq = 52;
    O.prototype.FV = Math.pow(2, bq);
    O.prototype.F1 = bq - aK;
    O.prototype.F2 = 2 * aK - bq;
    var aI = "0123456789abcdefghijklmnopqrstuvwxyz";
    var ac = new Array();
    var bE,
    an;
    bE = "0".charCodeAt(0);
    for (an = 0; an <= 9; ++an) {
        ac[bE++] = an
    }
    bE = "a".charCodeAt(0);
    for (an = 10; an < 36; ++an) {
        ac[bE++] = an
    }
    bE = "A".charCodeAt(0);
    for (an = 10; an < 36; ++an) {
        ac[bE++] = an
    }
    function P(t) {
        return aI.charAt(t)
    }
    function bg(z, t) {
        var L = ac[z.charCodeAt(t)];
        return (L == null) ? -1: L
    }
    function i(z) {
        for (var t = this.t - 1; t >= 0; --t) {
            z[t] = this[t]
        }
        z.t = this.t;
        z.s = this.s

    }
    function ae(t) {
        this.t = 1;
        this.s = (t < 0) ? -1: 0;
        if (t > 0) {
            this[0] = t
        } else {
            if (t < -1) {
                this[0] = t + DV
            } else {
                this.t = 0
            }
        }
    }
    function au(t) {
        var z = ai();
        z.fromInt(t);
        return z
    }
    function C(bW, t) {
        var bT;
        if (t == 16) {
            bT = 4
        } else {
            if (t == 8) {
                bT = 3
            } else {
                if (t == 256) {
                    bT = 8
                } else {
                    if (t == 2) {
                        bT = 1
                    } else {
                        if (t == 32) {
                            bT = 5
                        } else {
                            if (t == 4) {
                                bT = 2
                            } else {
                                this.fromRadix(bW, t);
                                return
                            }
                        }
                    }
                }
            }
        }
        this.t = 0;
        this.s = 0;
        var bV = bW.length,
        L = false,
        z = 0;
        while (--bV >= 0) {
            var bU = (bT == 8) ? bW[bV] & 255: bg(bW, bV);
            if (bU < 0) {
                if (bW.charAt(bV) == "-") {
                    L = true
                }
                continue
            }
            L = false;
            if (z == 0) {
                this[this.t++] = bU
            } else {
                if (z + bT > this.DB) {
                    this[this.t - 1] |= (bU & ((1 << (this.DB - z)) - 1)) << z;
                    this[this.t++] = (bU >> (this.DB - z))
                } else {
                    this[this.t - 1] |= bU << z
                }
            }
            z += bT;
            if (z >= this.DB) {
                z -= this.DB
            }
        }
        if (bT == 8 && (bW[0] & 128) != 0) {
            this.s = -1;
            if (z > 0) {
                this[this.t - 1] |= ((1 << (this.DB - z)) - 1) << z
            }
        }
        this.clamp();
        if (L) {
            O.ZERO.subTo(this, this)
        }
    }
    function q() {
        var t = this.s & this.DM;
        while (this.t > 0 && this[this.t - 1] == t) {--this.t
        }
    }
    function j(bX) {
        if (this.s < 0) {
            return "-" + this.negate().toString(bX)
        }
        var bW;
        if (bX == 16) {
            bW = 4
        } else {
            if (bX == 8) {
                bW = 3
            } else {
                if (bX == 2) {
                    bW = 1
                } else {
                    if (bX == 32) {
                        bW = 5
                    } else {
                        if (bX == 4) {
                            bW = 2
                        } else {
                            return this.toRadix(bX)
                        }
                    }
                }
            }
        }
        var bT = (1 << bW) - 1,
        L,
        t = false,
        bV = "",
        bU = this.t;
        var z = this.DB - (bU * this.DB) % bW;
        if (bU-->0) {
            if (z < this.DB && (L = this[bU] >> z) > 0) {
                t = true;
                bV = P(L)
            }
            while (bU >= 0) {
                if (z < bW) {
                    L = (this[bU] & ((1 << z) - 1)) << (bW - z);
                    L |= this[--bU] >> (z += this.DB - bW)
                } else {
                    L = (this[bU] >> (z -= bW)) & bT;
                    if (z <= 0) {
                        z += this.DB; --bU
                    }
                }
                if (L > 0) {
                    t = true
                }
                if (t) {
                    bV += P(L)
                }
            }
        }
        return t ? bV: "0"
    }
    function a8() {
        var t = ai();
        O.ZERO.subTo(this, t);
        return t
    }
    function aV() {
        return (this.s < 0) ? this.negate() : this
    }
    function aT(t) {
        var L = this.s - t.s;
        if (L != 0) {
            return L
        }
        var z = this.t;
        L = z - t.t;
        if (L != 0) {
            return (this.s < 0) ? -L: L
        }
        while (--z >= 0) {
            if ((L = this[z] - t[z]) != 0) {
                return L

            }
        }
        return 0
    }
    function bm(z) {
        var t = 1,
        L;
        if ((L = z >>> 16) != 0) {
            z = L;
            t += 16
        }
        if ((L = z >> 8) != 0) {
            z = L;
            t += 8
        }
        if ((L = z >> 4) != 0) {
            z = L;
            t += 4
        }
        if ((L = z >> 2) != 0) {
            z = L;
            t += 2
        }
        if ((L = z >> 1) != 0) {
            z = L;
            t += 1
        }
        return t
    }
    function aL() {
        if (this.t <= 0) {
            return 0
        }
        return this.DB * (this.t - 1) + bm(this[this.t - 1] ^ (this.s & this.DM))
    }
    function bJ(L, z) {
        var t;
        for (t = this.t - 1; t >= 0; --t) {
            z[t + L] = this[t]
        }
        for (t = L - 1; t >= 0; --t) {
            z[t] = 0
        }
        z.t = this.t + L;
        z.s = this.s
    }
    function bA(L, z) {
        for (var t = L; t < this.t; ++t) {
            z[t - L] = this[t]
        }
        z.t = Math.max(this.t - L, 0);
        z.s = this.s
    }
    function a3(L, bV) {
        var bX = L % this.DB;
        var bT = this.DB - bX;
        var t = (1 << bT) - 1;
        var bW = Math.floor(L / this.DB),
        z = (this.s << bX) & this.DM,
        bU;
        for (bU = this.t - 1; bU >= 0; --bU) {
            bV[bU + bW + 1] = (this[bU] >> bT) | z;
            z = (this[bU] & t) << bX
        }
        for (bU = bW - 1; bU >= 0; --bU) {
            bV[bU] = 0
        }
        bV[bW] = z;
        bV.t = this.t + bW + 1;
        bV.s = this.s;
        bV.clamp()
    }
    function af(bW, bT) {
        bT.s = this.s;
        var bV = Math.floor(bW / this.DB);
        if (bV >= this.t) {
            bT.t = 0;
            return
        }
        var t = bW % this.DB;
        var L = this.DB - t;
        var z = (1 << t) - 1;
        bT[0] = this[bV] >> t;
        for (var bU = bV + 1; bU < this.t; ++bU) {
            bT[bU - bV - 1] |= (this[bU] & z) << L;
            bT[bU - bV] = this[bU] >> t
        }
        if (t > 0) {
            bT[this.t - bV - 1] |= (this.s & z) << L
        }
        bT.t = this.t - bV;
        bT.clamp()
    }
    function A(t, bT) {
        var bU = 0,
        z = 0,
        L = Math.min(t.t, this.t);
        while (bU < L) {
            z += this[bU] - t[bU];
            bT[bU++] = z & this.DM;
            z >>= this.DB
        }
        if (t.t < this.t) {
            z -= t.s;
            while (bU < this.t) {
                z += this[bU];
                bT[bU++] = z & this.DM;
                z >>= this.DB
            }
            z += this.s
        } else {
            z += this.s;
            while (bU < t.t) {
                z -= t[bU];
                bT[bU++] = z & this.DM;
                z >>= this.DB
            }
            z -= t.s
        }
        bT.s = (z < 0) ? -1: 0;
        if (z < -1) {
            bT[bU++] = this.DV + z
        } else {
            if (z > 0) {
                bT[bU++] = z
            }
        }
        bT.t = bU;
        bT.clamp()
    }
    function ao(t, bT) {
        var bU = this.abs(),
        z = t.abs();
        var L = bU.t;
        bT.t = L + z.t;
        while (--L >= 0) {
            bT[L] = 0
        }
        for (L = 0; L < z.t; ++L) {
            bT[L + bU.t] = bU.am(0, z[L], bT, L, 0, bU.t)
        }
        bT.s = 0;
        bT.clamp();
        if (this.s != t.s) {
            O.ZERO.subTo(bT, bT)

        }
    }
    function aP(L) {
        var t = this.abs();
        var z = L.t = 2 * t.t;
        while (--z >= 0) {
            L[z] = 0
        }
        for (z = 0; z < t.t - 1; ++z) {
            var bT = t.am(z, t[z], L, 2 * z, 0, 1);
            if ((L[z + t.t] += t.am(z + 1, 2 * t[z], L, 2 * z + 1, bT, t.t - z - 1)) >= t.DV) {
                L[z + t.t] -= t.DV;
                L[z + t.t + 1] = 1
            }
        }
        if (L.t > 0) {
            L[L.t - 1] += t.am(z, t[z], L, 2 * z, 0, 1)
        }
        L.s = 0;
        L.clamp()
    }
    function bI(L, bW, bV) {
        var b5 = L.abs();
        if (b5.t <= 0) {
            return
        }
        var bX = this.abs();
        if (bX.t < b5.t) {
            if (bW != null) {
                bW.fromInt(0)
            }
            if (bV != null) {
                this.copyTo(bV)
            }
            return
        }
        if (bV == null) {
            bV = ai()
        }
        var bU = ai(),
        bZ = this.s,
        bY = L.s;
        var b4 = this.DB - bm(b5[b5.t - 1]);
        if (b4 > 0) {
            b5.lShiftTo(b4, bU);
            bX.lShiftTo(b4, bV)
        } else {
            b5.copyTo(bU);
            bX.copyTo(bV)
        }
        var b1 = bU.t;
        var z = bU[b1 - 1];
        if (z == 0) {
            return
        }
        var b0 = z * (1 << this.F1) + ((b1 > 1) ? bU[b1 - 2] >> this.F2: 0);
        var b8 = this.FV / b0,
        b7 = (1 << this.F1) / b0,
        b6 = 1 << this.F2;
        var b3 = bV.t,
        b2 = b3 - b1,
        t = (bW == null) ? ai() : bW;
        bU.dlShiftTo(b2, t);
        if (bV.compareTo(t) >= 0) {
            bV[bV.t++] = 1;
            bV.subTo(t, bV)
        }
        O.ONE.dlShiftTo(b1, t);
        t.subTo(bU, bU);
        while (bU.t < b1) {
            bU[bU.t++] = 0
        }
        while (--b2 >= 0) {
            var bT = (bV[--b3] == z) ? this.DM: Math.floor(bV[b3] * b8 + (bV[b3 - 1] + b6) * b7);
            if ((bV[b3] += bU.am(0, bT, bV, b2, 0, b1)) < bT) {
                bU.dlShiftTo(b2, t);
                bV.subTo(t, bV);
                while (bV[b3] < --bT) {
                    bV.subTo(t, bV)
                }
            }
        }
        if (bW != null) {
            bV.drShiftTo(b1, bW);
            if (bZ != bY) {
                O.ZERO.subTo(bW, bW)
            }
        }
        bV.t = b1;
        bV.clamp();
        if (b4 > 0) {
            bV.rShiftTo(b4, bV)
        }
        if (bZ < 0) {
            O.ZERO.subTo(bV, bV)
        }
    }
    function F(t) {
        var z = ai();
        this.abs().divRemTo(t, null, z);
        if (this.s < 0 && z.compareTo(O.ZERO) > 0) {
            t.subTo(z, z)
        }
        return z
    }
    function bj(t) {
        this.m = t
    }
    function bG(t) {
        if (t.s < 0 || t.compareTo(this.m) >= 0) {
            return t.mod(this.m)
        } else {
            return t
        }
    }
    function bM(t) {
        return t
    }
    function a0(t) {
        t.divRemTo(this.m, null, t)
    }
    function aM(t, L, z) {
        t.multiplyTo(L, z);
        this.reduce(z)
    }
    function ag(t, z) {
        t.squareTo(z);
        this.reduce(z)
    }
    bj.prototype.convert = bG;
    bj.prototype.revert = bM;
    bj.prototype.reduce = a0;
    bj.prototype.mulTo = aM;
    bj.prototype.sqrTo = ag;
    function B() {
        if (this.t < 1) {
            return 0
        }
        var t = this[0];
        if ((t & 1) == 0) {
            return 0
        }
        var z = t & 3;
        z = (z * (2 - (t & 15) * z)) & 15;
        z = (z * (2 - (t & 255) * z)) & 255;
        z = (z * (2 - (((t & 65535) * z) & 65535))) & 65535;
        z = (z * (2 - t * z % this.DV)) % this.DV;
        return (z > 0) ? this.DV - z: -z
    }
    function o(t) {
        this.m = t;
        this.mp = t.invDigit();
        this.mpl = this.mp & 32767;
        this.mph = this.mp >> 15;
        this.um = (1 << (t.DB - 15)) - 1;
        this.mt2 = 2 * t.t
    }
    function aS(t) {
        var z = ai();
        t.abs().dlShiftTo(this.m.t, z);
        z.divRemTo(this.m, null, z);
        if (t.s < 0 && z.compareTo(O.ZERO) > 0) {
            this.m.subTo(z, z)
        }
        return z
    }
    function bS(t) {
        var z = ai();
        t.copyTo(z);
        this.reduce(z);
        return z
    }
    function bb(t) {
        while (t.t <= this.mt2) {
            t[t.t++] = 0
        }
        for (var L = 0; L < this.m.t; ++L) {
            var z = t[L] & 32767;
            var bT = (z * this.mpl + (((z * this.mph + (t[L] >> 15) * this.mpl) & this.um) << 15)) & t.DM;
            z = L + this.m.t;
            t[z] += this.m.am(0, bT, t, L, 0, this.m.t);
            while (t[z] >= t.DV) {
                t[z] -= t.DV;
                t[++z]++
            }
        }
        t.clamp();
        t.drShiftTo(this.m.t, t);
        if (t.compareTo(this.m) >= 0) {
            t.subTo(this.m, t)
        }
    }
    function aF(t, z) {
        t.squareTo(z);
        this.reduce(z)
    }
    function bK(t, L, z) {
        t.multiplyTo(L, z);
        this.reduce(z)
    }
    o.prototype.convert = aS;
    o.prototype.revert = bS;
    o.prototype.reduce = bb;
    o.prototype.mulTo = bK;
    o.prototype.sqrTo = aF;
    function ay() {
        return ((this.t > 0) ? (this[0] & 1) : this.s) == 0
    }
    function bp(t, L) {
        if (t > 4294967295 || t < 1) {
            return O.ONE
        }
        var bW = ai(),
        bV = ai(),
        z = L.convert(this),
        bT = bm(t) - 1;
        z.copyTo(bW);
        while (--bT >= 0) {
            L.sqrTo(bW, bV);
            if ((t & (1 << bT)) > 0) {
                L.mulTo(bV, z, bW)
            } else {
                var bU = bW;
                bW = bV;
                bV = bU
            }
        }
        return L.revert(bW)
    }
    function r(L, z) {
        var t;
        if (L < 256 || z.isEven()) {
            t = new bj(z)
        } else {
            t = new o(z)
        }
        return this.exp(L, t)
    }
    O.prototype.copyTo = i;
    O.prototype.fromInt = ae;
    O.prototype.fromString = C;
    O.prototype.clamp = q;
    O.prototype.dlShiftTo = bJ;
    O.prototype.drShiftTo = bA;
    O.prototype.lShiftTo = a3;
    O.prototype.rShiftTo = af;
    O.prototype.subTo = A;
    O.prototype.multiplyTo = ao;
    O.prototype.squareTo = aP;
    O.prototype.divRemTo = bI;
    O.prototype.invDigit = B;
    O.prototype.isEven = ay;
    O.prototype.exp = bp;
    O.prototype.toString = j;
    O.prototype.negate = a8;
    O.prototype.abs = aV;
    O.prototype.compareTo = aT;
    O.prototype.bitLength = aL;
    O.prototype.mod = F;
    O.prototype.modPowInt = r;
    O.ZERO = au(0);
    O.ONE = au(1);
    function aE() {
        var t = ai();
        this.copyTo(t);
        return t
    }
    function aO() {
        if (this.s < 0) {
            if (this.t == 1) {
                return this[0] - this.DV
            } else {
                if (this.t == 0) {
                    return - 1
                }
            }
        } else {
            if (this.t == 1) {
                return this[0]
            } else {
                if (this.t == 0) {
                    return 0
                }
            }
        }
        return ((this[1] & ((1 << (32 - this.DB)) - 1)) << this.DB) | this[0]
    }
    function bh() {
        return (this.t == 0) ? this.s: (this[0] << 24) >> 24
    }
    function m() {
        return (this.t == 0) ? this.s: (this[0] << 16) >> 16

    }
    function bw(t) {
        return Math.floor(Math.LN2 * this.DB / Math.log(t))
    }
    function ap() {
        if (this.s < 0) {
            return - 1
        } else {
            if (this.t <= 0 || (this.t == 1 && this[0] <= 0)) {
                return 0
            } else {
                return 1
            }
        }
    }
    function X(L) {
        if (L == null) {
            L = 10
        }
        if (this.signum() == 0 || L < 2 || L > 36) {
            return "0"
        }
        var bT = this.chunkSize(L);
        var bV = Math.pow(L, bT);
        var bW = au(bV),
        t = ai(),
        z = ai(),
        bU = "";
        this.divRemTo(bW, t, z);
        while (t.signum() > 0) {
            bU = (bV + z.intValue()).toString(L).substr(1) + bU;
            t.divRemTo(bW, t, z)
        }
        return z.intValue().toString(L) + bU
    }
    function bu(bY, bV) {
        this.fromInt(0);
        if (bV == null) {
            bV = 10
        }
        var bT = this.chunkSize(bV);
        var bU = Math.pow(bV, bT),
        L = false,
        t = 0,
        bX = 0;
        for (var z = 0; z < bY.length; ++z) {
            var bW = bg(bY, z);
            if (bW < 0) {
                if (bY.charAt(z) == "-" && this.signum() == 0) {
                    L = true
                }
                continue
            }
            bX = bV * bX + bW;
            if (++t >= bT) {
                this.dMultiply(bU);
                this.dAddOffset(bX, 0);
                t = 0;
                bX = 0
            }
        }
        if (t > 0) {
            this.dMultiply(Math.pow(bV, t));
            this.dAddOffset(bX, 0)
        }
        if (L) {
            O.ZERO.subTo(this, this)
        }
    }
    function H(t, bT, bU) {
        if ("number" == typeof bT) {
            if (t < 2) {
                this.fromInt(1)
            } else {
                this.fromNumber(t, bU);
                if (!this.testBit(t - 1)) {
                    this.bitwiseTo(O.ONE.shiftLeft(t - 1), aA, this)
                }
                if (this.isEven()) {
                    this.dAddOffset(1, 0)
                }
                while (!this.isProbablePrime(bT)) {
                    this.dAddOffset(2, 0);
                    if (this.bitLength() > t) {
                        this.subTo(O.ONE.shiftLeft(t - 1), this)
                    }
                }
            }
        } else {
            var z = new Array(),
            L = t & 7;
            z.length = (t >> 3) + 1;
            bT.nextBytes(z);
            if (L > 0) {
                z[0] &= ((1 << L) - 1)
            } else {
                z[0] = 0
            }
            this.fromString(z, 256)
        }
    }
    function T() {
        var t = this.t,
        bT = new Array();
        bT[0] = this.s;
        var bU = this.DB - (t * this.DB) % 8,
        z,
        L = 0;
        if (t-->0) {
            if (bU < this.DB && (z = this[t] >> bU) != (this.s & this.DM) >> bU) {
                bT[L++] = z | (this.s << (this.DB - bU))
            }
            while (t >= 0) {
                if (bU < 8) {
                    z = (this[t] & ((1 << bU) - 1)) << (8 - bU);
                    z |= this[--t] >> (bU += this.DB - 8)
                } else {
                    z = (this[t] >> (bU -= 8)) & 255;
                    if (bU <= 0) {
                        bU += this.DB;
                        --t
                    }
                }
                if ((z & 128) != 0) {
                    z |= -256
                }
                if (L == 0 && (this.s & 128) != (z & 128)) {++L
                }
                if (L > 0 || z != this.s) {
                    bT[L++] = z
                }
            }
        }
        return bT
    }
    function a7(t) {
        return (this.compareTo(t) == 0)
    }
    function aR(t) {
        return (this.compareTo(t) < 0) ? this: t
    }
    function s(t) {
        return (this.compareTo(t) > 0) ? this: t
    }
    function D(t, z, bU) {
        var bT,
        L,
        bV = Math.min(t.t, this.t);
        for (bT = 0; bT < bV; ++bT) {
            bU[bT] = z(this[bT], t[bT])
        }
        if (t.t < this.t) {
            L = t.s & this.DM;
            for (bT = bV; bT < this.t; ++bT) {
                bU[bT] = z(this[bT], L)
            }
            bU.t = this.t
        } else {
            L = this.s & this.DM;
            for (bT = bV; bT < t.t; ++bT) {
                bU[bT] = z(L, t[bT])
            }
            bU.t = t.t
        }
        bU.s = z(this.s, t.s);
        bU.clamp()
    }
    function e(t, z) {
        return t & z
    }
    function k(t) {
        var z = ai();
        this.bitwiseTo(t, e, z);
        return z
    }
    function aA(t, z) {
        return t | z
    }
    function aZ(t) {
        var z = ai();
        this.bitwiseTo(t, aA, z);
        return z
    }
    function R(t, z) {
        return t ^ z
    }
    function bB(t) {
        var z = ai();
        this.bitwiseTo(t, R, z);
        return z
    }
    function ar(t, z) {
        return t & ~z

    }
    function bv(t) {
        var z = ai();
        this.bitwiseTo(t, ar, z);
        return z
    }
    function bt() {
        var z = ai();
        for (var t = 0; t < this.t; ++t) {
            z[t] = this.DM & ~this[t]
        }
        z.t = this.t;
        z.s = ~this.s;
        return z
    }
    function a1(z) {
        var t = ai();
        if (z < 0) {
            this.rShiftTo( - z, t)
        } else {
            this.lShiftTo(z, t)
        }
        return t
    }
    function w(z) {
        var t = ai();
        if (z < 0) {
            this.lShiftTo( - z, t)
        } else {
            this.rShiftTo(z, t)
        }
        return t
    }
    function bP(t) {
        if (t == 0) {
            return - 1
        }
        var z = 0;
        if ((t & 65535) == 0) {
            t >>= 16;
            z += 16
        }
        if ((t & 255) == 0) {
            t >>= 8;
            z += 8
        }
        if ((t & 15) == 0) {
            t >>= 4;
            z += 4
        }
        if ((t & 3) == 0) {
            t >>= 2;
            z += 2
        }
        if ((t & 1) == 0) {++z
        }
        return z
    }
    function bn() {
        for (var t = 0; t < this.t; ++t) {
            if (this[t] != 0) {
                return t * this.DB + bP(this[t])
            }
        }
        if (this.s < 0) {
            return this.t * this.DB
        }
        return - 1
    }
    function aX(t) {
        var z = 0;
        while (t != 0) {
            t &= t - 1; ++z
        }
        return z
    }
    function a4() {
        var L = 0,
        t = this.s & this.DM;
        for (var z = 0; z < this.t; ++z) {
            L += aX(this[z] ^ t)
        }
        return L
    }
    function bc(z) {
        var t = Math.floor(z / this.DB);
        if (t >= this.t) {
            return (this.s != 0)
        }
        return ((this[t] & (1 << (z % this.DB))) != 0)
    }
    function g(L, z) {
        var t = O.ONE.shiftLeft(L);
        this.bitwiseTo(t, z, t);
        return t
    }
    function J(t) {
        return this.changeBit(t, aA)
    }
    function by(t) {
        return this.changeBit(t, ar)
    }
    function f(t) {
        return this.changeBit(t, R)
    }
    function U(t, bT) {
        var bU = 0,
        z = 0,
        L = Math.min(t.t, this.t);
        while (bU < L) {
            z += this[bU] + t[bU];
            bT[bU++] = z & this.DM;
            z >>= this.DB
        }
        if (t.t < this.t) {
            z += t.s;
            while (bU < this.t) {
                z += this[bU];
                bT[bU++] = z & this.DM;
                z >>= this.DB
            }
            z += this.s
        } else {
            z += this.s;
            while (bU < t.t) {
                z += t[bU];
                bT[bU++] = z & this.DM;
                z >>= this.DB
            }
            z += t.s
        }
        bT.s = (z < 0) ? -1: 0;
        if (z > 0) {
            bT[bU++] = z
        } else {
            if (z < -1) {
                bT[bU++] = this.DV + z
            }
        }
        bT.t = bU;
        bT.clamp()
    }
    function ab(t) {
        var z = ai();
        this.addTo(t, z);
        return z
    }
    function ba(t) {
        var z = ai();
        this.subTo(t, z);
        return z
    }
    function G(t) {
        var z = ai();
        this.multiplyTo(t, z);
        return z
    }
    function aC() {
        var t = ai();
        this.squareTo(t);
        return t
    }
    function b(t) {
        var z = ai();
        this.divRemTo(t, z, null);
        return z
    }
    function aw(t) {
        var z = ai();
        this.divRemTo(t, null, z);
        return z
    }
    function bi(t) {
        var L = ai(),
        z = ai();
        this.divRemTo(t, L, z);
        return new Array(L, z)
    }
    function Q(t) {
        this[this.t] = this.am(0, t - 1, this, 0, 0, this.t); ++this.t;
        this.clamp()
    }
    function E(z, t) {
        if (z == 0) {
            return
        }
        while (this.t <= t) {
            this[this.t++] = 0
        }
        this[t] += z;
        while (this[t] >= this.DV) {
            this[t] -= this.DV;
            if (++t >= this.t) {
                this[this.t++] = 0
            }++this[t]
        }
    }
    function aD() {}
    function aj(t) {
        return t
    }
    function aB(t, L, z) {
        t.multiplyTo(L, z)
    }
    function al(t, z) {
        t.squareTo(z)
    }
    aD.prototype.convert = aj;
    aD.prototype.revert = aj;
    aD.prototype.mulTo = aB;
    aD.prototype.sqrTo = al;
    function n(t) {
        return this.exp(t, new aD())
    }
    function u(bU, bT, t) {
        var L = Math.min(this.t + bU.t, bT);
        t.s = 0;
        t.t = L;
        while (L > 0) {
            t[--L] = 0
        }
        var z;
        for (z = t.t - this.t;
        L < z; ++L) {
            t[L + this.t] = this.am(0, bU[L], t, L, 0, this.t)
        }
        for (z = Math.min(bU.t, bT); L < z; ++L) {
            this.am(0, bU[L], t, L, 0, bT - L)
        }
        t.clamp()
    }
    function M(t, bT, L) {--bT;
        var z = L.t = this.t + t.t - bT;
        L.s = 0;
        while (--z >= 0) {
            L[z] = 0
        }
        for (z = Math.max(bT - this.t, 0); z < t.t; ++z) {
            L[this.t + z - bT] = this.am(bT - z, t[z], L, 0, 0, this.t + z - bT)
        }
        L.clamp();
        L.drShiftTo(1, L)
    }
    function bs(t) {
        this.r2 = ai();
        this.q3 = ai();
        O.ONE.dlShiftTo(2 * t.t, this.r2);
        this.mu = this.r2.divide(t);
        this.m = t
    }
    function bN(t) {
        if (t.s < 0 || t.t > 2 * this.m.t) {
            return t.mod(this.m)
        } else {
            if (t.compareTo(this.m) < 0) {
                return t
            } else {
                var z = ai();
                t.copyTo(z);
                this.reduce(z);
                return z
            }
        }
    }
    function h(t) {
        return t
    }
    function aq(t) {
        t.drShiftTo(this.m.t - 1, this.r2);
        if (t.t > this.m.t + 1) {
            t.t = this.m.t + 1;
            t.clamp()
        }
        this.mu.multiplyUpperTo(this.r2, this.m.t + 1, this.q3);
        this.m.multiplyLowerTo(this.q3, this.m.t + 1, this.r2);
        while (t.compareTo(this.r2) < 0) {
            t.dAddOffset(1, this.m.t + 1)

        }
        t.subTo(this.r2, t);
        while (t.compareTo(this.m) >= 0) {
            t.subTo(this.m, t)
        }
    }
    function br(t, z) {
        t.squareTo(z);
        this.reduce(z)
    }
    function ah(t, L, z) {
        t.multiplyTo(L, z);
        this.reduce(z)
    }
    bs.prototype.convert = bN;
    bs.prototype.revert = h;
    bs.prototype.reduce = aq;
    bs.prototype.mulTo = ah;
    bs.prototype.sqrTo = br;
    function Z(L, bT) {
        var t = L.bitLength(),
        b3,
        b0 = au(1),
        b1;
        if (t <= 0) {
            return b0
        } else {
            if (t < 18) {
                b3 = 1
            } else {
                if (t < 48) {
                    b3 = 3
                } else {
                    if (t < 144) {
                        b3 = 4
                    } else {
                        if (t < 768) {
                            b3 = 5
                        } else {
                            b3 = 6
                        }
                    }
                }
            }
        }
        if (t < 8) {
            b1 = new bj(bT)
        } else {
            if (bT.isEven()) {
                b1 = new bs(bT)
            } else {
                b1 = new o(bT)
            }
        }
        var z = new Array(),
        b2 = 3,
        bU = b3 - 1,
        bV = (1 << b3) - 1;
        z[1] = b1.convert(this);
        if (b3 > 1) {
            var bZ = ai();
            b1.sqrTo(z[1], bZ);
            while (b2 <= bV) {
                z[b2] = ai();
                b1.mulTo(bZ, z[b2 - 2], z[b2]);
                b2 += 2
            }
        }
        var b4 = L.t - 1,
        bW,
        bX = true,
        b5 = ai(),
        bY;
        t = bm(L[b4]) - 1;
        while (b4 >= 0) {
            if (t >= bU) {
                bW = (L[b4] >> (t - bU)) & bV
            } else {
                bW = (L[b4] & ((1 << (t + 1)) - 1)) << (bU - t);
                if (b4 > 0) {
                    bW |= L[b4 - 1] >> (this.DB + t - bU)
                }
            }
            b2 = b3;
            while ((bW & 1) == 0) {
                bW >>= 1; --b2
            }
            if ((t -= b2) < 0) {
                t += this.DB; --b4
            }
            if (bX) {
                z[bW].copyTo(b0);
                bX = false
            } else {
                while (b2 > 1) {
                    b1.sqrTo(b0, b5);
                    b1.sqrTo(b5, b0);
                    b2 -= 2
                }
                if (b2 > 0) {
                    b1.sqrTo(b0, b5)
                } else {
                    bY = b0;
                    b0 = b5;
                    b5 = bY
                }
                b1.mulTo(b5, z[bW], b0)
            }
            while (b4 >= 0 && (L[b4] & (1 << t)) == 0) {
                b1.sqrTo(b0, b5);
                bY = b0;
                b0 = b5;
                b5 = bY;
                if (--t < 0) {
                    t = this.DB - 1; --b4
                }
            }
        }
        return b1.revert(b0)
    }
    function a6(bU) {
        var t = (this.s < 0) ? this.negate() : this.clone();
        var z = (bU.s < 0) ? bU.negate() : bU.clone();
        if (t.compareTo(z) < 0) {
            var L = t;
            t = z;
            z = L
        }
        var bT = t.getLowestSetBit(),
        bV = z.getLowestSetBit();
        if (bV < 0) {
            return t
        }
        if (bT < bV) {
            bV = bT
        }
        if (bV > 0) {
            t.rShiftTo(bV, t);
            z.rShiftTo(bV, z)
        }
        while (t.signum() > 0) {
            if ((bT = t.getLowestSetBit()) > 0) {
                t.rShiftTo(bT, t)
            }
            if ((bT = z.getLowestSetBit()) > 0) {
                z.rShiftTo(bT, z)
            }
            if (t.compareTo(z) >= 0) {
                t.subTo(z, t);
                t.rShiftTo(1, t)

            } else {
                z.subTo(t, z);
                z.rShiftTo(1, z)
            }
        }
        if (bV > 0) {
            z.lShiftTo(bV, z)
        }
        return z
    }
    function N(bT) {
        if (bT <= 0) {
            return 0
        }
        var L = this.DV % bT,
        z = (this.s < 0) ? bT - 1: 0;
        if (this.t > 0) {
            if (L == 0) {
                z = this[0] % bT
            } else {
                for (var t = this.t - 1; t >= 0; --t) {
                    z = (L * z + this[t]) % bT
                }
            }
        }
        return z
    }
    function aH(bX) {
        var t = bX.isEven();
        if ((this.isEven() && t) || bX.signum() == 0) {
            return O.ZERO
        }
        var bW = bX.clone(),
        bV = this.clone();
        var bT = au(1),
        L = au(0),
        bU = au(0),
        z = au(1);
        while (bW.signum() != 0) {
            while (bW.isEven()) {
                bW.rShiftTo(1, bW);
                if (t) {
                    if (!bT.isEven() || !L.isEven()) {
                        bT.addTo(this, bT);
                        L.subTo(bX, L)
                    }
                    bT.rShiftTo(1, bT)
                } else {
                    if (!L.isEven()) {
                        L.subTo(bX, L)
                    }
                }
                L.rShiftTo(1, L)
            }
            while (bV.isEven()) {
                bV.rShiftTo(1, bV);
                if (t) {
                    if (!bU.isEven() || !z.isEven()) {
                        bU.addTo(this, bU);
                        z.subTo(bX, z)
                    }
                    bU.rShiftTo(1, bU)
                } else {
                    if (!z.isEven()) {
                        z.subTo(bX, z)
                    }
                }
                z.rShiftTo(1, z)
            }
            if (bW.compareTo(bV) >= 0) {
                bW.subTo(bV, bW);
                if (t) {
                    bT.subTo(bU, bT)
                }
                L.subTo(z, L)
            } else {
                bV.subTo(bW, bV);
                if (t) {
                    bU.subTo(bT, bU)
                }
                z.subTo(L, z)
            }
        }
        if (bV.compareTo(O.ONE) != 0) {
            return O.ZERO
        }
        if (z.compareTo(bX) >= 0) {
            return z.subtract(bX)
        }
        if (z.signum() < 0) {
            z.addTo(bX, z)
        } else {
            return z
        }
        if (z.signum() < 0) {
            return z.add(bX)
        } else {
            return z
        }
    }
    var I = [2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47, 53, 59, 61, 67, 71, 73, 79, 83, 89, 97, 101, 103, 107, 109, 113, 127, 131, 137, 139, 149, 151, 157, 163, 167, 173, 179, 181, 191, 193, 197, 199, 211, 223, 227, 229, 233, 239, 241, 251, 257, 263, 269, 271, 277, 281, 283, 293, 307, 311, 313, 317, 331, 337, 347, 349, 353, 359, 367, 373, 379, 383, 389, 397, 401, 409, 419, 421, 431, 433, 439, 443, 449, 457, 461, 463, 467, 479, 487, 491, 499, 503, 509, 521, 523, 541, 547, 557, 563, 569, 571, 577, 587, 593, 599, 601, 607, 613, 617, 619, 631, 641, 643, 647, 653, 659, 661, 673, 677, 683, 691, 701, 709, 719, 727, 733, 739, 743, 751, 757, 761, 769, 773, 787, 797, 809, 811, 821, 823, 827, 829, 839, 853, 857, 859, 863, 877, 881, 883, 887, 907, 911, 919, 929, 937, 941, 947, 953, 967, 971, 977, 983, 991, 997];
    var bz = (1 << 26) / I[I.length - 1];
    function bL(t) {
        var bT,
        bU = this.abs();
        if (bU.t == 1 && bU[0] <= I[I.length - 1]) {
            for (bT = 0; bT < I.length; ++bT) {
                if (bU[0] == I[bT]) {
                    return true
                }
            }
            return false
        }
        if (bU.isEven()) {
            return false
        }
        bT = 1;
        while (bT < I.length) {
            var L = I[bT],
            z = bT + 1;
            while (z < I.length && L < bz) {
                L *= I[z++]
            }
            L = bU.modInt(L);
            while (bT < z) {
                if (L % I[bT++] == 0) {
                    return false
                }
            }
        }
        return bU.millerRabin(t)
    }
    function S(t) {
        var bX = this.subtract(O.ONE);
        var bW = bX.getLowestSetBit();
        if (bW <= 0) {
            return false
        }
        var L = bX.shiftRight(bW);
        t = (t + 1) >> 1;
        if (t > I.length) {
            t = I.length
        }
        var bV = ai();
        for (var bT = 0; bT < t; ++bT) {
            bV.fromInt(I[Math.floor(Math.random() * I.length)]);
            var bU = bV.modPow(L, this);
            if (bU.compareTo(O.ONE) != 0 && bU.compareTo(bX) != 0) {
                var z = 1;
                while (z++<bW && bU.compareTo(bX) != 0) {
                    bU = bU.modPowInt(2, this);
                    if (bU.compareTo(O.ONE) == 0) {
                        return false
                    }
                }
                if (bU.compareTo(bX) != 0) {
                    return false

                }
            }
        }
        return true
    }
    O.prototype.chunkSize = bw;
    O.prototype.toRadix = X;
    O.prototype.fromRadix = bu;
    O.prototype.fromNumber = H;
    O.prototype.bitwiseTo = D;
    O.prototype.changeBit = g;
    O.prototype.addTo = U;
    O.prototype.dMultiply = Q;
    O.prototype.dAddOffset = E;
    O.prototype.multiplyLowerTo = u;
    O.prototype.multiplyUpperTo = M;
    O.prototype.modInt = N;
    O.prototype.millerRabin = S;
    O.prototype.clone = aE;
    O.prototype.intValue = aO;
    O.prototype.byteValue = bh;
    O.prototype.shortValue = m;
    O.prototype.signum = ap;
    O.prototype.toByteArray = T;
    O.prototype.equals = a7;
    O.prototype.min = aR;
    O.prototype.max = s;
    O.prototype.and = k;
    O.prototype.or = aZ;
    O.prototype.xor = bB;
    O.prototype.andNot = bv;
    O.prototype.not = bt;
    O.prototype.shiftLeft = a1;
    O.prototype.shiftRight = w;
    O.prototype.getLowestSetBit = bn;
    O.prototype.bitCount = a4;
    O.prototype.testBit = bc;
    O.prototype.setBit = J;
    O.prototype.clearBit = by;
    O.prototype.flipBit = f;
    O.prototype.add = ab;
    O.prototype.subtract = ba;
    O.prototype.multiply = G;
    O.prototype.divide = b;
    O.prototype.remainder = aw;
    O.prototype.divideAndRemainder = bi;
    O.prototype.modPow = Z;
    O.prototype.modInverse = aH;
    O.prototype.pow = n;
    O.prototype.gcd = a6;
    O.prototype.isProbablePrime = bL;
    O.prototype.square = aC;
    function p() {
        this.i = 0;
        this.j = 0;
        this.S = new Array()
    }
    function a2(bT) {
        var t,
        z,
        L;
        for (t = 0; t < 256; ++t) {
            this.S[t] = t
        }
        z = 0;
        for (t = 0; t < 256; ++t) {
            z = (z + this.S[t] + bT[t % bT.length]) & 255;
            L = this.S[t];
            this.S[t] = this.S[z];
            this.S[z] = L
        }
        this.i = 0;
        this.j = 0
    }
    function bo() {
        var t;
        this.i = (this.i + 1) & 255;
        this.j = (this.j + this.S[this.i]) & 255;
        t = this.S[this.i];
        this.S[this.i] = this.S[this.j];
        this.S[this.j] = t;
        return this.S[(t + this.S[this.i]) & 255]
    }
    p.prototype.init = a2;
    p.prototype.next = bo;
    function am() {
        return new p()
    }
    var bF = 256;
    var ax;
    var bd;
    var aJ;
    if (bd == null) {
        bd = new Array();
        aJ = 0;
        var V;
        if (window.crypto && window.crypto.getRandomValues) {
            var be = new Uint32Array(256);
            window.crypto.getRandomValues(be);
            for (V = 0; V < be.length; ++V) {
                bd[aJ++] = be[V] & 255
            }
        }
        var W = function(z) {
            this.count = this.count || 0;
            if (this.count >= 256 || aJ >= bF) {
                if (window.removeEventListener) {
                    window.removeEventListener("mousemove", W)
                } else {
                    if (window.detachEvent) {
                        window.detachEvent("onmousemove", W)
                    }
                }
                return
            }
            this.count += 1;
            var t = z.x + z.y;
            bd[aJ++] = t & 255
        };
        if (window.addEventListener) {
            window.addEventListener("mousemove", W)
        } else {
            if (window.attachEvent) {
                window.attachEvent("onmousemove", W)
            }
        }
    }
    function bH() {
        if (ax == null) {
            ax = am();
            while (aJ < bF) {
                var t = Math.floor(65536 * Math.random());
                bd[aJ++] = t & 255
            }
            ax.init(bd);
            for (aJ = 0; aJ < bd.length; ++aJ) {
                bd[aJ] = 0
            }
            aJ = 0
        }
        return ax.next()
    }
    function az(z) {
        var t;
        for (t = 0; t < z.length;
        ++t) {
            z[t] = bH()
        }
    }
    function av() {}
    av.prototype.nextBytes = az;
    function bD(z, t) {
        return new O(z, t)
    }
    function aN(L, bT) {
        var t = "";
        var z = 0;
        while (z + bT < L.length) {
            t += L.substring(z, z + bT) + "\n";
            z += bT
        }
        return t + L.substring(z, L.length)
    }
    function ad(t) {
        if (t < 16) {
            return "0" + t.toString(16)
        } else {
            return t.toString(16)
        }
    }
    function bx(bT, bW) {
        if (bW < bT.length + 11) {
            console.error("Message too long for RSA");
            return null
        }
        var t = new Array();
        var bV = bT.length - 1;
        while (bV >= 0 && bW > 0) {
            var L = bT.charCodeAt(bV--);
            if (L < 128) {
                t[--bW] = L
            } else {
                if ((L > 127) && (L < 2048)) {
                    t[--bW] = (L & 63) | 128;
                    t[--bW] = (L >> 6) | 192
                } else {
                    t[--bW] = (L & 63) | 128;
                    t[--bW] = ((L >> 6) & 63) | 128;
                    t[--bW] = (L >> 12) | 224
                }
            }
        }
        t[--bW] = 0;
        var z = new av();
        var bU = new Array();
        while (bW > 2) {
            bU[0] = 0;
            while (bU[0] == 0) {
                z.nextBytes(bU)
            }
            t[--bW] = bU[0]
        }
        t[--bW] = 2;
        t[--bW] = 0;
        return new O(t)
    }
    function aU() {
        this.n = null;
        this.e = 0;
        this.d = null;
        this.p = null;
        this.q = null;
        this.dmp1 = null;
        this.dmq1 = null;
        this.coeff = null
    }
    function aW(z, t) {
        if (z != null && t != null && z.length > 0 && t.length > 0) {
            this.n = bD(z, 16);
            this.e = parseInt(t, 16)
        } else {
            console.error("Invalid RSA public key")
        }
    }
    function bR(t) {
        return t.modPowInt(this.e, this.n)
    }
    function aY(L) {
        var t = bx(L, (this.n.bitLength() + 7) >> 3);
        if (t == null) {
            return null
        }
        var bT = this.doPublic(t);
        if (bT == null) {
            return null
        }
        var z = bT.toString(16);
        if ((z.length & 1) == 0) {
            return z
        } else {
            return "0" + z
        }
    }
    aU.prototype.doPublic = bR;
    aU.prototype.setPublic = aW;
    aU.prototype.encrypt = aY;
    function bl(bU, t) {
        var bV = bU.toByteArray();
        var bT = 0;
        while (bT < bV.length && bV[bT] == 0) {++bT
        }
        if (bV.length - bT != t - 1 || bV[bT] != 2) {
            return null
        }++bT;
        while (bV[bT] != 0) {
            if (++bT >= bV.length) {
                return null
            }
        }
        var z = "";
        while (++bT < bV.length) {
            var L = bV[bT] & 255;
            if (L < 128) {
                z += String.fromCharCode(L)

            } else {
                if ((L > 191) && (L < 224)) {
                    z += String.fromCharCode(((L & 31) << 6) | (bV[bT + 1] & 63)); ++bT
                } else {
                    z += String.fromCharCode(((L & 15) << 12) | ((bV[bT + 1] & 63) << 6) | (bV[bT + 2] & 63));
                    bT += 2
                }
            }
        }
        return z
    }
    function K(L, t) {
        var z = new av();
        var bW = L >> 1;
        this.e = parseInt(t, 16);
        var bT = new O(t, 16);
        for (;;) {
            for (;;) {
                this.p = new O(L - bW, 1, z);
                if (this.p.subtract(O.ONE).gcd(bT).compareTo(O.ONE) == 0 && this.p.isProbablePrime(10)) {
                    break
                }
            }
            for (;;) {
                this.q = new O(bW, 1, z);
                if (this.q.subtract(O.ONE).gcd(bT).compareTo(O.ONE) == 0 && this.q.isProbablePrime(10)) {
                    break
                }
            }
            if (this.p.compareTo(this.q) <= 0) {
                var bY = this.p;
                this.p = this.q;
                this.q = bY
            }
            var bX = this.p.subtract(O.ONE);
            var bU = this.q.subtract(O.ONE);
            var bV = bX.multiply(bU);
            if (bV.gcd(bT).compareTo(O.ONE) == 0) {
                this.n = this.p.multiply(this.q);
                this.d = bT.modInverse(bV);
                this.dmp1 = this.d.mod(bX);
                this.dmq1 = this.d.mod(bU);
                this.coeff = this.q.modInverse(this.p);
                break
            }
        }
    }
    function bk(z) {
        var L = bD(z, 16);
        var t = this.doPrivate(L);
        if (t == null) {
            return null
        }
        return bl(t, (this.n.bitLength() + 7) >> 3)
    }
    aU.prototype.generate = K;
    aU.prototype.decrypt = bk; (function() {
        var z = function(b0, bY, bZ) {
            var bW = new av();
            var bT = b0 >> 1;
            this.e = parseInt(bY, 16);
            var bV = new O(bY, 16);
            var bX = this;
            var bU = function() {
                var b3 = function() {
                    if (bX.p.compareTo(bX.q) <= 0) {
                        var b5 = bX.p;
                        bX.p = bX.q;
                        bX.q = b5
                    }
                    var b7 = bX.p.subtract(O.ONE);
                    var b4 = bX.q.subtract(O.ONE);
                    var b6 = b7.multiply(b4);
                    if (b6.gcd(bV).compareTo(O.ONE) == 0) {
                        bX.n = bX.p.multiply(bX.q);
                        bX.d = bV.modInverse(b6);
                        bX.dmp1 = bX.d.mod(b7);
                        bX.dmq1 = bX.d.mod(b4);
                        bX.coeff = bX.q.modInverse(bX.p);
                        setTimeout(function() {
                            bZ()
                        },
                        0)
                    } else {
                        setTimeout(bU, 0)
                    }
                };
                var b1 = function() {
                    bX.q = ai();
                    bX.q.fromNumberAsync(bT, 1, bW, 
                    function() {
                        bX.q.subtract(O.ONE).gcda(bV, 
                        function(b4) {
                            if (b4.compareTo(O.ONE) == 0 && bX.q.isProbablePrime(10)) {
                                setTimeout(b3, 0)

                            } else {
                                setTimeout(b1, 0)
                            }
                        })
                    })
                };
                var b2 = function() {
                    bX.p = ai();
                    bX.p.fromNumberAsync(b0 - bT, 1, bW, 
                    function() {
                        bX.p.subtract(O.ONE).gcda(bV, 
                        function(b4) {
                            if (b4.compareTo(O.ONE) == 0 && bX.p.isProbablePrime(10)) {
                                setTimeout(b1, 0)
                            } else {
                                setTimeout(b2, 0)
                            }
                        })
                    })
                };
                setTimeout(b2, 0)
            };
            setTimeout(bU, 0)
        };
        aU.prototype.generateAsync = z;
        var t = function(bU, b0) {
            var bT = (this.s < 0) ? this.negate() : this.clone();
            var bZ = (bU.s < 0) ? bU.negate() : bU.clone();
            if (bT.compareTo(bZ) < 0) {
                var bW = bT;
                bT = bZ;
                bZ = bW
            }
            var bV = bT.getLowestSetBit(),
            bX = bZ.getLowestSetBit();
            if (bX < 0) {
                b0(bT);
                return
            }
            if (bV < bX) {
                bX = bV
            }
            if (bX > 0) {
                bT.rShiftTo(bX, bT);
                bZ.rShiftTo(bX, bZ)
            }
            var bY = function() {
                if ((bV = bT.getLowestSetBit()) > 0) {
                    bT.rShiftTo(bV, bT)
                }
                if ((bV = bZ.getLowestSetBit()) > 0) {
                    bZ.rShiftTo(bV, bZ)
                }
                if (bT.compareTo(bZ) >= 0) {
                    bT.subTo(bZ, bT);
                    bT.rShiftTo(1, bT)
                } else {
                    bZ.subTo(bT, bZ);
                    bZ.rShiftTo(1, bZ)

                }
                if (! (bT.signum() > 0)) {
                    if (bX > 0) {
                        bZ.lShiftTo(bX, bZ)
                    }
                    setTimeout(function() {
                        b0(bZ)
                    },
                    0)
                } else {
                    setTimeout(bY, 0)
                }
            };
            setTimeout(bY, 10)
        };
        O.prototype.gcda = t;
        var L = function(bX, bU, b0, bZ) {
            if ("number" == typeof bU) {
                if (bX < 2) {
                    this.fromInt(1)
                } else {
                    this.fromNumber(bX, b0);
                    if (!this.testBit(bX - 1)) {
                        this.bitwiseTo(O.ONE.shiftLeft(bX - 1), aA, this)
                    }
                    if (this.isEven()) {
                        this.dAddOffset(1, 0)
                    }
                    var bW = this;
                    var bV = function() {
                        bW.dAddOffset(2, 0);
                        if (bW.bitLength() > bX) {
                            bW.subTo(O.ONE.shiftLeft(bX - 1), bW)
                        }
                        if (bW.isProbablePrime(bU)) {
                            setTimeout(function() {
                                bZ()
                            },
                            0)
                        } else {
                            setTimeout(bV, 0)
                        }
                    };
                    setTimeout(bV, 0)
                }
            } else {
                var bT = new Array(),
                bY = bX & 7;
                bT.length = (bX >> 3) + 1;
                bU.nextBytes(bT);
                if (bY > 0) {
                    bT[0] &= ((1 << bY) - 1)
                } else {
                    bT[0] = 0
                }
                this.fromString(bT, 256)
            }
        };
        O.prototype.fromNumberAsync = L
    })();
    var at = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
    var ak = "=";
    function x(L) {
        var z;
        var bT;
        var t = "";
        for (z = 0; z + 3 <= L.length; z += 3) {
            bT = parseInt(L.substring(z, z + 3), 16);
            t += at.charAt(bT >> 6) + at.charAt(bT & 63)
        }
        if (z + 1 == L.length) {
            bT = parseInt(L.substring(z, z + 1), 16);
            t += at.charAt(bT << 2)
        } else {
            if (z + 2 == L.length) {
                bT = parseInt(L.substring(z, z + 2), 16);
                t += at.charAt(bT >> 2) + at.charAt((bT & 3) << 4)
            }
        }
        while ((t.length & 3) > 0) {
            t += ak
        }
        return t
    }
    function bf(bT) {
        var bU = "";
        var t;
        var L = 0;
        var z;
        for (t = 0; t < bT.length; ++t) {
            if (bT.charAt(t) == ak) {
                break
            }
            v = at.indexOf(bT.charAt(t));
            if (v < 0) {
                continue
            }
            if (L == 0) {
                bU += P(v >> 2);
                z = v & 3;
                L = 1
            } else {
                if (L == 1) {
                    bU += P((z << 2) | (v >> 4));
                    z = v & 15;
                    L = 2
                } else {
                    if (L == 2) {
                        bU += P(z);
                        bU += P(v >> 2);
                        z = v & 3;
                        L = 3
                    } else {
                        bU += P((z << 2) | (v >> 4));
                        bU += P(v & 15);
                        L = 0
                    }
                }
            }
        }
        if (L == 1) {
            bU += P(z << 2)
        }
        return bU
    }
    function aa(bT) {
        var L = bf(bT);
        var z;
        var t = new Array();
        for (z = 0; 2 * z < L.length; ++z) {
            t[z] = parseInt(L.substring(2 * z, 2 * z + 2), 16)

        }
        return t
    }
    var a5 = a5 || {};
    a5.env = a5.env || {};
    var a9 = a5,
    bQ = Object.prototype,
    y = "[object Function]",
    c = ["toString", "valueOf"];
    a5.env.parseUA = function(bV) {
        var bW = function(bY) {
            var bZ = 0;
            return parseFloat(bY.replace(/\./g, 
            function() {
                return (bZ++==1) ? "": "."
            }))
        },
        L = navigator,
        bX = {
            ie: 0,
            opera: 0,
            gecko: 0,
            webkit: 0,
            chrome: 0,
            mobile: null,
            air: 0,
            ipad: 0,
            iphone: 0,
            ipod: 0,
            ios: null,
            android: 0,
            webos: 0,
            caja: L && L.cajaVersion,
            secure: false,
            os: null
        },
        bT = bV || (navigator && navigator.userAgent),
        t = window && window.location,
        z = t && t.href,
        bU;
        bX.secure = z && (z.toLowerCase().indexOf("https") === 0);
        if (bT) {
            if ((/windows|win32/i).test(bT)) {
                bX.os = "windows"
            } else {
                if ((/macintosh/i).test(bT)) {
                    bX.os = "macintosh"
                } else {
                    if ((/rhino/i).test(bT)) {
                        bX.os = "rhino"
                    }
                }
            }
            if ((/KHTML/).test(bT)) {
                bX.webkit = 1
            }
            bU = bT.match(/AppleWebKit\/([^\s]*)/);
            if (bU && bU[1]) {
                bX.webkit = bW(bU[1]);
                if (/ Mobile\//.test(bT)) {
                    bX.mobile = "Apple";
                    bU = bT.match(/OS ([^\s]*)/);
                    if (bU && bU[1]) {
                        bU = bW(bU[1].replace("_", "."))
                    }
                    bX.ios = bU;
                    bX.ipad = bX.ipod = bX.iphone = 0;
                    bU = bT.match(/iPad|iPod|iPhone/);
                    if (bU && bU[0]) {
                        bX[bU[0].toLowerCase()] = bX.ios
                    }
                } else {
                    bU = bT.match(/NokiaN[^\/]*|Android \d\.\d|webOS\/\d\.\d/);
                    if (bU) {
                        bX.mobile = bU[0]
                    }
                    if (/webOS/.test(bT)) {
                        bX.mobile = "WebOS";
                        bU = bT.match(/webOS\/([^\s]*);/);
                        if (bU && bU[1]) {
                            bX.webos = bW(bU[1])
                        }
                    }
                    if (/ Android/.test(bT)) {
                        bX.mobile = "Android";
                        bU = bT.match(/Android ([^\s]*);/);
                        if (bU && bU[1]) {
                            bX.android = bW(bU[1])
                        }
                    }
                }
                bU = bT.match(/Chrome\/([^\s]*)/);
                if (bU && bU[1]) {
                    bX.chrome = bW(bU[1])
                } else {
                    bU = bT.match(/AdobeAIR\/([^\s]*)/);
                    if (bU) {
                        bX.air = bU[0]
                    }
                }
            }
            if (!bX.webkit) {
                bU = bT.match(/Opera[\s\/]([^\s]*)/);
                if (bU && bU[1]) {
                    bX.opera = bW(bU[1]);
                    bU = bT.match(/Version\/([^\s]*)/);
                    if (bU && bU[1]) {
                        bX.opera = bW(bU[1])

                    }
                    bU = bT.match(/Opera Mini[^;]*/);
                    if (bU) {
                        bX.mobile = bU[0]
                    }
                } else {
                    bU = bT.match(/MSIE\s([^;]*)/);
                    if (bU && bU[1]) {
                        bX.ie = bW(bU[1])
                    } else {
                        bU = bT.match(/Gecko\/([^\s]*)/);
                        if (bU) {
                            bX.gecko = 1;
                            bU = bT.match(/rv:([^\s\)]*)/);
                            if (bU && bU[1]) {
                                bX.gecko = bW(bU[1])
                            }
                        }
                    }
                }
            }
        }
        return bX
    };
    a5.env.ua = a5.env.parseUA();
    a5.isFunction = function(t) {
        return (typeof t === "function") || bQ.toString.apply(t) === y
    };
    a5._IEEnumFix = (a5.env.ua.ie) ? 
    function(bT, t) {
        var bU,
        L,
        z;
        for (bU = 0; bU < c.length; bU = bU + 1) {
            L = c[bU];
            z = t[L];
            if (a9.isFunction(z) && z != bQ[L]) {
                bT[L] = z
            }
        }
    }: function() {};
    a5.extend = function(t, bT, bU) {
        if (!bT || !t) {
            throw new Error("extend failed, please check that all dependencies are included.")
        }
        var z = function() {},
        L;
        z.prototype = bT.prototype;
        t.prototype = new z();
        t.prototype.constructor = t;
        t.superclass = bT.prototype;
        if (bT.prototype.constructor == bQ.constructor) {
            bT.prototype.constructor = bT

        }
        if (bU) {
            for (L in bU) {
                if (a9.hasOwnProperty(bU, L)) {
                    t.prototype[L] = bU[L]
                }
            }
            a9._IEEnumFix(t.prototype, bU)
        }
    };
    if (typeof KJUR == "undefined" || !KJUR) {
        KJUR = {}
    }
    if (typeof KJUR.asn1 == "undefined" || !KJUR.asn1) {
        KJUR.asn1 = {}
    }
    KJUR.asn1.ASN1Util = new
    function() {
        this.integerToByteHex = function(t) {
            var z = t.toString(16);
            if ((z.length % 2) == 1) {
                z = "0" + z
            }
            return z
        };
        this.bigIntToMinTwosComplementsHex = function(L) {
            var t = L.toString(16);
            if (t.substr(0, 1) != "-") {
                if (t.length % 2 == 1) {
                    t = "0" + t
                } else {
                    if (!t.match(/^[0-7]/)) {
                        t = "00" + t
                    }
                }
            } else {
                var bT = t.substr(1);
                var bW = bT.length;
                if (bW % 2 == 1) {
                    bW += 1
                } else {
                    if (!t.match(/^[0-7]/)) {
                        bW += 2
                    }
                }
                var bX = "";
                for (var bV = 0; bV < bW; bV++) {
                    bX += "f"
                }
                var bU = new O(bX, 16);
                var z = bU.xor(L).add(O.ONE);
                t = z.toString(16).replace(/^-/, "")
            }
            return t
        }
    };
    KJUR.asn1.ASN1Object = function() {
        var bT = true;
        var t = null;
        var bU = "00";
        var z = "00";
        var L = "";
        this.getLengthHexFromValue = function() {
            if (typeof this.hV == "undefined" || this.hV == null) {
                throw "this.hV is null or undefined."
            }
            if (this.hV.length % 2 == 1) {
                throw "value hex must be even length: n=" + L.length + ",v=" + this.hV
            }
            var bY = this.hV.length / 2;
            var bX = bY.toString(16);
            if (bX.length % 2 == 1) {
                bX = "0" + bX
            }
            if (bY < 128) {
                return bX
            } else {
                var bW = bX.length / 2;
                if (bW > 15) {
                    throw "ASN.1 length too long to represent by 8x: n = " + bY.toString(16)
                }
                var bV = 128 + bW;
                return bV.toString(16) + bX
            }
        };
        this.getEncodedHex = function() {
            if (this.hTLV == null || this.isModified) {
                this.hV = this.getFreshValueHex();
                this.hL = this.getLengthHexFromValue();
                this.hTLV = this.hT + this.hL + this.hV;
                this.isModified = false
            }
            return this.hTLV
        };
        this.getValueHex = function() {
            this.getEncodedHex();
            return this.hV
        };
        this.getFreshValueHex = function() {
            return ""
        }
    };
    KJUR.asn1.DERAbstractString = function(L) {
        KJUR.asn1.DERAbstractString.superclass.constructor.call(this);
        var z = null;
        var t = null;
        this.getString = function() {
            return this.s
        };
        this.setString = function(bT) {
            this.hTLV = null;
            this.isModified = true;
            this.s = bT;
            this.hV = stohex(this.s)
        };
        this.setStringHex = function(bT) {
            this.hTLV = null;
            this.isModified = true;
            this.s = null;
            this.hV = bT
        };
        this.getFreshValueHex = function() {
            return this.hV
        };
        if (typeof L != "undefined") {
            if (typeof L.str != "undefined") {
                this.setString(L.str)
            } else {
                if (typeof L.hex != "undefined") {
                    this.setStringHex(L.hex)
                }
            }
        }
    };
    a5.extend(KJUR.asn1.DERAbstractString, KJUR.asn1.ASN1Object);
    KJUR.asn1.DERAbstractTime = function(L) {
        KJUR.asn1.DERAbstractTime.superclass.constructor.call(this);
        var z = null;
        var t = null;
        this.localDateToUTC = function(bU) {
            utc = bU.getTime() + (bU.getTimezoneOffset() * 60000);
            var bT = new Date(utc);
            return bT
        };
        this.formatDate = function(b0, b2) {
            var bV = this.zeroPadding;
            var b1 = this.localDateToUTC(b0);
            var bT = String(b1.getFullYear());
            if (b2 == "utc") {
                bT = bT.substr(2, 2)
            }
            var bZ = bV(String(b1.getMonth() + 1), 2);
            var bU = bV(String(b1.getDate()), 2);
            var bW = bV(String(b1.getHours()), 2);
            var bX = bV(String(b1.getMinutes()), 2);
            var bY = bV(String(b1.getSeconds()), 2);
            return bT + bZ + bU + bW + bX + bY + "Z"
        };
        this.zeroPadding = function(bU, bT) {
            if (bU.length >= bT) {
                return bU
            }
            return new Array(bT - bU.length + 1).join("0") + bU
        };
        this.getString = function() {
            return this.s
        };
        this.setString = function(bT) {
            this.hTLV = null;
            this.isModified = true;
            this.s = bT;
            this.hV = stohex(this.s)
        };
        this.setByDateValue = function(bV, bX, bZ, bY, bT, bU) {
            var bW = new Date(Date.UTC(bV, bX - 1, bZ, bY, bT, bU, 0));
            this.setByDate(bW)
        };
        this.getFreshValueHex = function() {
            return this.hV
        }
    };
    a5.extend(KJUR.asn1.DERAbstractTime, KJUR.asn1.ASN1Object);
    KJUR.asn1.DERAbstractStructured = function(z) {
        KJUR.asn1.DERAbstractString.superclass.constructor.call(this);
        var t = null;
        this.setByASN1ObjectArray = function(L) {
            this.hTLV = null;
            this.isModified = true;
            this.asn1Array = L
        };
        this.appendASN1Object = function(L) {
            this.hTLV = null;
            this.isModified = true;
            this.asn1Array.push(L)
        };
        this.asn1Array = new Array();
        if (typeof z != "undefined") {
            if (typeof z.array != "undefined") {
                this.asn1Array = z.array
            }
        }
    };
    a5.extend(KJUR.asn1.DERAbstractStructured, KJUR.asn1.ASN1Object);
    KJUR.asn1.DERBoolean = function() {
        KJUR.asn1.DERBoolean.superclass.constructor.call(this);
        this.hT = "01";
        this.hTLV = "0101ff"
    };
    a5.extend(KJUR.asn1.DERBoolean, KJUR.asn1.ASN1Object);
    KJUR.asn1.DERInteger = function(t) {
        KJUR.asn1.DERInteger.superclass.constructor.call(this);
        this.hT = "02";
        this.setByBigInteger = function(z) {
            this.hTLV = null;
            this.isModified = true;
            this.hV = KJUR.asn1.ASN1Util.bigIntToMinTwosComplementsHex(z)
        };
        this.setByInteger = function(L) {
            var z = new O(String(L), 10);
            this.setByBigInteger(z)
        };
        this.setValueHex = function(z) {
            this.hV = z
        };
        this.getFreshValueHex = function() {
            return this.hV
        };
        if (typeof t != "undefined") {
            if (typeof t.bigint != "undefined") {
                this.setByBigInteger(t.bigint)
            } else {
                if (typeof t["int"] != "undefined") {
                    this.setByInteger(t["int"])
                } else {
                    if (typeof t.hex != "undefined") {
                        this.setValueHex(t.hex)
                    }
                }
            }
        }
    };
    a5.extend(KJUR.asn1.DERInteger, KJUR.asn1.ASN1Object);
    KJUR.asn1.DERBitString = function(t) {
        KJUR.asn1.DERBitString.superclass.constructor.call(this);
        this.hT = "03";
        this.setHexValueIncludingUnusedBits = function(z) {
            this.hTLV = null;
            this.isModified = true;
            this.hV = z
        };
        this.setUnusedBitsAndHexValue = function(z, bT) {
            if (z < 0 || 7 < z) {
                throw "unused bits shall be from 0 to 7: u = " + z
            }
            var L = "0" + z;
            this.hTLV = null;
            this.isModified = true;
            this.hV = L + bT
        };
        this.setByBinaryString = function(bT) {
            bT = bT.replace(/0+$/, "");
            var L = 8 - bT.length % 8;
            if (L == 8) {
                L = 0
            }
            for (var bV = 0; bV <= L; bV++) {
                bT += "0"
            }
            var bW = "";
            for (var bV = 0; bV < bT.length - 1; bV += 8) {
                var bU = bT.substr(bV, 8);
                var z = parseInt(bU, 2).toString(16);
                if (z.length == 1) {
                    z = "0" + z
                }
                bW += z
            }
            this.hTLV = null;
            this.isModified = true;
            this.hV = "0" + L + bW
        };
        this.setByBooleanArray = function(bT) {
            var L = "";
            for (var z = 0; z < bT.length; z++) {
                if (bT[z] == true) {
                    L += "1"
                } else {
                    L += "0"
                }
            }
            this.setByBinaryString(L)
        };
        this.newFalseArray = function(bT) {
            var z = new Array(bT);
            for (var L = 0; L < bT; L++) {
                z[L] = false
            }
            return z
        };
        this.getFreshValueHex = function() {
            return this.hV
        };
        if (typeof t != "undefined") {
            if (typeof t.hex != "undefined") {
                this.setHexValueIncludingUnusedBits(t.hex)
            } else {
                if (typeof t.bin != "undefined") {
                    this.setByBinaryString(t.bin)
                } else {
                    if (typeof t.array != "undefined") {
                        this.setByBooleanArray(t.array)
                    }
                }
            }
        }
    };
    a5.extend(KJUR.asn1.DERBitString, KJUR.asn1.ASN1Object);
    KJUR.asn1.DEROctetString = function(t) {
        KJUR.asn1.DEROctetString.superclass.constructor.call(this, t);
        this.hT = "04"
    };
    a5.extend(KJUR.asn1.DEROctetString, KJUR.asn1.DERAbstractString);
    KJUR.asn1.DERNull = function() {
        KJUR.asn1.DERNull.superclass.constructor.call(this);
        this.hT = "05";
        this.hTLV = "0500"
    };
    a5.extend(KJUR.asn1.DERNull, KJUR.asn1.ASN1Object);
    KJUR.asn1.DERObjectIdentifier = function(L) {
        var z = function(bT) {
            var bU = bT.toString(16);
            if (bU.length == 1) {
                bU = "0" + bU
            }
            return bU
        };
        var t = function(bY) {
            var bX = "";
            var bU = new O(bY, 10);
            var bT = bU.toString(2);
            var bV = 7 - bT.length % 7;
            if (bV == 7) {
                bV = 0
            }
            var b0 = "";
            for (var bW = 0; bW < bV; bW++) {
                b0 += "0"
            }
            bT = b0 + bT;
            for (var bW = 0; bW < bT.length - 1; bW += 7) {
                var bZ = bT.substr(bW, 7);
                if (bW != bT.length - 7) {
                    bZ = "1" + bZ
                }
                bX += z(parseInt(bZ, 2))
            }
            return bX
        };
        KJUR.asn1.DERObjectIdentifier.superclass.constructor.call(this);
        this.hT = "06";
        this.setValueHex = function(bT) {
            this.hTLV = null;
            this.isModified = true;
            this.s = null;
            this.hV = bT
        };
        this.setValueOidString = function(bU) {
            if (!bU.match(/^[0-9.]+$/)) {
                throw "malformed oid string: " + bU
            }
            var bV = "";
            var bX = bU.split(".");
            var bW = parseInt(bX[0]) * 40 + parseInt(bX[1]);
            bV += z(bW);
            bX.splice(0, 2);
            for (var bT = 0; bT < bX.length; bT++) {
                bV += t(bX[bT])
            }
            this.hTLV = null;
            this.isModified = true;
            this.s = null;
            this.hV = bV
        };
        this.setValueName = function(bU) {
            if (typeof KJUR.asn1.x509.OID.name2oidList[bU] != "undefined") {
                var bT = KJUR.asn1.x509.OID.name2oidList[bU];
                this.setValueOidString(bT)
            } else {
                throw "DERObjectIdentifier oidName undefined: " + bU
            }
        };
        this.getFreshValueHex = function() {
            return this.hV
        };
        if (typeof L != "undefined") {
            if (typeof L.oid != "undefined") {
                this.setValueOidString(L.oid)
            } else {
                if (typeof L.hex != "undefined") {
                    this.setValueHex(L.hex)

                } else {
                    if (typeof L.name != "undefined") {
                        this.setValueName(L.name)
                    }
                }
            }
        }
    };
    a5.extend(KJUR.asn1.DERObjectIdentifier, KJUR.asn1.ASN1Object);
    KJUR.asn1.DERUTF8String = function(t) {
        KJUR.asn1.DERUTF8String.superclass.constructor.call(this, t);
        this.hT = "0c"
    };
    a5.extend(KJUR.asn1.DERUTF8String, KJUR.asn1.DERAbstractString);
    KJUR.asn1.DERNumericString = function(t) {
        KJUR.asn1.DERNumericString.superclass.constructor.call(this, t);
        this.hT = "12"
    };
    a5.extend(KJUR.asn1.DERNumericString, KJUR.asn1.DERAbstractString);
    KJUR.asn1.DERPrintableString = function(t) {
        KJUR.asn1.DERPrintableString.superclass.constructor.call(this, t);
        this.hT = "13"
    };
    a5.extend(KJUR.asn1.DERPrintableString, KJUR.asn1.DERAbstractString);
    KJUR.asn1.DERTeletexString = function(t) {
        KJUR.asn1.DERTeletexString.superclass.constructor.call(this, t);
        this.hT = "14"
    };
    a5.extend(KJUR.asn1.DERTeletexString, KJUR.asn1.DERAbstractString);
    KJUR.asn1.DERIA5String = function(t) {
        KJUR.asn1.DERIA5String.superclass.constructor.call(this, t);
        this.hT = "16"
    };
    a5.extend(KJUR.asn1.DERIA5String, KJUR.asn1.DERAbstractString);
    KJUR.asn1.DERUTCTime = function(t) {
        KJUR.asn1.DERUTCTime.superclass.constructor.call(this, t);
        this.hT = "17";
        this.setByDate = function(z) {
            this.hTLV = null;
            this.isModified = true;
            this.date = z;
            this.s = this.formatDate(this.date, "utc");
            this.hV = stohex(this.s)
        };
        if (typeof t != "undefined") {
            if (typeof t.str != "undefined") {
                this.setString(t.str)
            } else {
                if (typeof t.hex != "undefined") {
                    this.setStringHex(t.hex)
                } else {
                    if (typeof t.date != "undefined") {
                        this.setByDate(t.date)
                    }
                }
            }
        }
    };
    a5.extend(KJUR.asn1.DERUTCTime, KJUR.asn1.DERAbstractTime);
    KJUR.asn1.DERGeneralizedTime = function(t) {
        KJUR.asn1.DERGeneralizedTime.superclass.constructor.call(this, t);
        this.hT = "18";
        this.setByDate = function(z) {
            this.hTLV = null;
            this.isModified = true;
            this.date = z;
            this.s = this.formatDate(this.date, "gen");
            this.hV = stohex(this.s)
        };
        if (typeof t != "undefined") {
            if (typeof t.str != "undefined") {
                this.setString(t.str)
            } else {
                if (typeof t.hex != "undefined") {
                    this.setStringHex(t.hex)
                } else {
                    if (typeof t.date != "undefined") {
                        this.setByDate(t.date)
                    }
                }
            }
        }
    };
    a5.extend(KJUR.asn1.DERGeneralizedTime, KJUR.asn1.DERAbstractTime);
    KJUR.asn1.DERSequence = function(t) {
        KJUR.asn1.DERSequence.superclass.constructor.call(this, t);
        this.hT = "30";
        this.getFreshValueHex = function() {
            var L = "";
            for (var z = 0; z < this.asn1Array.length; z++) {
                var bT = this.asn1Array[z];
                L += bT.getEncodedHex()
            }
            this.hV = L;
            return this.hV
        }
    };
    a5.extend(KJUR.asn1.DERSequence, KJUR.asn1.DERAbstractStructured);
    KJUR.asn1.DERSet = function(t) {
        KJUR.asn1.DERSet.superclass.constructor.call(this, t);
        this.hT = "31";
        this.getFreshValueHex = function() {
            var z = new Array();
            for (var L = 0; L < this.asn1Array.length; L++) {
                var bT = this.asn1Array[L];
                z.push(bT.getEncodedHex())
            }
            z.sort();
            this.hV = z.join("");
            return this.hV
        }
    };
    a5.extend(KJUR.asn1.DERSet, KJUR.asn1.DERAbstractStructured);
    KJUR.asn1.DERTaggedObject = function(t) {
        KJUR.asn1.DERTaggedObject.superclass.constructor.call(this);
        this.hT = "a0";
        this.hV = "";
        this.isExplicit = true;
        this.asn1Object = null;
        this.setASN1Object = function(z, L, bT) {
            this.hT = L;
            this.isExplicit = z;
            this.asn1Object = bT;
            if (this.isExplicit) {
                this.hV = this.asn1Object.getEncodedHex();
                this.hTLV = null;
                this.isModified = true
            } else {
                this.hV = null;
                this.hTLV = bT.getEncodedHex();
                this.hTLV = this.hTLV.replace(/^../, L);
                this.isModified = false
            }
        };
        this.getFreshValueHex = function() {
            return this.hV
        };
        if (typeof t != "undefined") {
            if (typeof t.tag != "undefined") {
                this.hT = t.tag
            }
            if (typeof t.explicit != "undefined") {
                this.isExplicit = t.explicit

            }
            if (typeof t.obj != "undefined") {
                this.asn1Object = t.obj;
                this.setASN1Object(this.isExplicit, this.hT, this.asn1Object)
            }
        }
    };
    a5.extend(KJUR.asn1.DERTaggedObject, KJUR.asn1.ASN1Object); (function(z) {
        var t = {},
        L;
        t.decode = function(bT) {
            var bV;
            if (L === z) {
                var bW = "0123456789ABCDEF",
                b0 = " \f\n\r\t\u00A0\u2028\u2029";
                L = [];
                for (bV = 0; bV < 16; ++bV) {
                    L[bW.charAt(bV)] = bV
                }
                bW = bW.toLowerCase();
                for (bV = 10; bV < 16; ++bV) {
                    L[bW.charAt(bV)] = bV
                }
                for (bV = 0; bV < b0.length; ++bV) {
                    L[b0.charAt(bV)] = -1
                }
            }
            var bU = [],
            bX = 0,
            bZ = 0;
            for (bV = 0; bV < bT.length; ++bV) {
                var bY = bT.charAt(bV);
                if (bY == "=") {
                    break
                }
                bY = L[bY];
                if (bY == -1) {
                    continue
                }
                if (bY === z) {
                    throw "Illegal character at offset " + bV
                }
                bX |= bY;
                if (++bZ >= 2) {
                    bU[bU.length] = bX;
                    bX = 0;
                    bZ = 0
                } else {
                    bX <<= 4
                }
            }
            if (bZ) {
                throw "Hex encoding incomplete: 4 bits missing"
            }
            return bU
        };
        window.Hex = t
    })(); (function(z) {
        var t = {},
        L;
        t.decode = function(bT) {
            var bW;
            if (L === z) {
                var bV = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/",
                b0 = "= \f\n\r\t\u00A0\u2028\u2029";
                L = [];
                for (bW = 0; bW < 64; ++bW) {
                    L[bV.charAt(bW)] = bW
                }
                for (bW = 0; bW < b0.length; ++bW) {
                    L[b0.charAt(bW)] = -1
                }
            }
            var bU = [];
            var bX = 0,
            bZ = 0;
            for (bW = 0; bW < bT.length; ++bW) {
                var bY = bT.charAt(bW);
                if (bY == "=") {
                    break
                }
                bY = L[bY];
                if (bY == -1) {
                    continue
                }
                if (bY === z) {
                    throw "Illegal character at offset " + bW
                }
                bX |= bY;
                if (++bZ >= 4) {
                    bU[bU.length] = (bX >> 16);
                    bU[bU.length] = (bX >> 8) & 255;
                    bU[bU.length] = bX & 255;
                    bX = 0;
                    bZ = 0
                } else {
                    bX <<= 6
                }
            }
            switch (bZ) {
            case 1:
                throw "Base64 encoding incomplete: at least 2 bits missing";
            case 2:
                bU[bU.length] = (bX >> 10);
                break;
            case 3:
                bU[bU.length] = (bX >> 16);
                bU[bU.length] = (bX >> 8) & 255;
                break
            }
            return bU
        };
        t.re = /-----BEGIN [^-]+-----([A-Za-z0-9+\/=\s]+)-----END [^-]+-----|begin-base64[^\n]+\n([A-Za-z0-9+\/=\s]+)====/;
        t.unarmor = function(bU) {
            var bT = t.re.exec(bU);
            if (bT) {
                if (bT[1]) {
                    bU = bT[1]
                } else {
                    if (bT[2]) {
                        bU = bT[2]
                    } else {
                        throw "RegExp out of sync"
                    }
                }
            }
            return t.decode(bU)
        };
        window.Base64 = t
    })(); (function(t) {
        var z = 100,
        bV = "\u2026",
        bU = {
            tag: function(bX, bY) {
                var bW = document.createElement(bX);
                bW.className = bY;
                return bW
            },
            text: function(bW) {
                return document.createTextNode(bW)
            }
        };
        function L(bW, bX) {
            if (bW instanceof L) {
                this.enc = bW.enc;
                this.pos = bW.pos
            } else {
                this.enc = bW;
                this.pos = bX
            }
        }
        L.prototype.get = function(bW) {
            if (bW === t) {
                bW = this.pos++
            }
            if (bW >= this.enc.length) {
                throw "Requesting byte offset " + bW + " on a stream of length " + this.enc.length
            }
            return this.enc[bW]
        };
        L.prototype.hexDigits = "0123456789ABCDEF";
        L.prototype.hexByte = function(bW) {
            return this.hexDigits.charAt((bW >> 4) & 15) + this.hexDigits.charAt(bW & 15)
        };
        L.prototype.hexDump = function(b0, bW, bX) {
            var bZ = "";
            for (var bY = b0; bY < bW; ++bY) {
                bZ += this.hexByte(this.get(bY));
                if (bX !== true) {
                    switch (bY & 15) {
                    case 7:
                        bZ += "  ";
                        break;
                    case 15:
                        bZ += "\n";
                        break;
                    default:
                        bZ += " "
                    }
                }
            }
            return bZ
        };
        L.prototype.parseStringISO = function(bZ, bW) {
            var bY = "";
            for (var bX = bZ; bX < bW; ++bX) {
                bY += String.fromCharCode(this.get(bX))
            }
            return bY
        };
        L.prototype.parseStringUTF = function(b0, bW) {
            var bY = "";
            for (var bX = b0; bX < bW;) {
                var bZ = this.get(bX++);
                if (bZ < 128) {
                    bY += String.fromCharCode(bZ)
                } else {
                    if ((bZ > 191) && (bZ < 224)) {
                        bY += String.fromCharCode(((bZ & 31) << 6) | (this.get(bX++) & 63))
                    } else {
                        bY += String.fromCharCode(((bZ & 15) << 12) | ((this.get(bX++) & 63) << 6) | (this.get(bX++) & 63))
                    }
                }
            }
            return bY
        };
        L.prototype.parseStringBMP = function(b1, bX) {
            var b0 = "";
            for (var bZ = b1; bZ < bX; bZ += 2) {
                var bW = this.get(bZ);
                var bY = this.get(bZ + 1);
                b0 += String.fromCharCode((bW << 8) + bY)
            }
            return b0
        };
        L.prototype.reTime = /^((?:1[89]|2\d)?\d\d)(0[1-9]|1[0-2])(0[1-9]|[12]\d|3[01])([01]\d|2[0-3])(?:([0-5]\d)(?:([0-5]\d)(?:[.,](\d{1,3}))?)?)?(Z|[-+](?:[0]\d|1[0-2])([0-5]\d)?)?$/;
        L.prototype.parseTime = function(bZ, bX) {
            var bY = this.parseStringISO(bZ, bX),
            bW = this.reTime.exec(bY);
            if (!bW) {
                return "Unrecognized time: " + bY
            }
            bY = bW[1] + "-" + bW[2] + "-" + bW[3] + " " + bW[4];
            if (bW[5]) {
                bY += ":" + bW[5];
                if (bW[6]) {
                    bY += ":" + bW[6];
                    if (bW[7]) {
                        bY += "." + bW[7]
                    }
                }
            }
            if (bW[8]) {
                bY += " UTC";
                if (bW[8] != "Z") {
                    bY += bW[8];
                    if (bW[9]) {
                        bY += ":" + bW[9]
                    }
                }
            }
            return bY
        };
        L.prototype.parseInteger = function(b1, bX) {
            var bW = bX - b1;
            if (bW > 4) {
                bW <<= 3;
                var bZ = this.get(b1);
                if (bZ === 0) {
                    bW -= 8
                } else {
                    while (bZ < 128) {
                        bZ <<= 1; --bW
                    }
                }
                return "(" + bW + " bit)"
            }
            var b0 = 0;
            for (var bY = b1; bY < bX; ++bY) {
                b0 = (b0 << 8) | this.get(bY)
            }
            return b0
        };
        L.prototype.parseBitString = function(bZ, b0) {
            var b4 = this.get(bZ),
            b2 = ((b0 - bZ - 1) << 3) - b4,
            bY = "(" + b2 + " bit)";
            if (b2 <= 20) {
                var bX = b4;
                bY += " ";
                for (var b3 = b0 - 1; b3 > bZ; --b3) {
                    var bW = this.get(b3);
                    for (var b1 = bX; b1 < 8; ++b1) {
                        bY += (bW >> b1) & 1 ? "1": "0"
                    }
                    bX = 0
                }
            }
            return bY

        };
        L.prototype.parseOctetString = function(b0, bX) {
            var bW = bX - b0,
            bZ = "(" + bW + " byte) ";
            if (bW > z) {
                bX = b0 + z
            }
            for (var bY = b0; bY < bX; ++bY) {
                bZ += this.hexByte(this.get(bY))
            }
            if (bW > z) {
                bZ += bV
            }
            return bZ
        };
        L.prototype.parseOID = function(b3, bX) {
            var b0 = "",
            b2 = 0,
            b1 = 0;
            for (var bZ = b3; bZ < bX; ++bZ) {
                var bY = this.get(bZ);
                b2 = (b2 << 7) | (bY & 127);
                b1 += 7;
                if (! (bY & 128)) {
                    if (b0 === "") {
                        var bW = b2 < 80 ? b2 < 40 ? 0: 1: 2;
                        b0 = bW + "." + (b2 - bW * 40)
                    } else {
                        b0 += "." + ((b1 >= 31) ? "bigint": b2)
                    }
                    b2 = b1 = 0
                }
            }
            return b0
        };
        function bT(bZ, b0, bY, bW, bX) {
            this.stream = bZ;
            this.header = b0;
            this.length = bY;
            this.tag = bW;
            this.sub = bX
        }
        bT.prototype.typeName = function() {
            if (this.tag === t) {
                return "unknown"
            }
            var bY = this.tag >> 6,
            bW = (this.tag >> 5) & 1,
            bX = this.tag & 31;
            switch (bY) {
            case 0:
                switch (bX) {
                case 0:
                    return "EOC";
                case 1:
                    return "BOOLEAN";
                case 2:
                    return "INTEGER";
                case 3:
                    return "BIT_STRING";
                case 4:
                    return "OCTET_STRING";
                    case 5:
                    return "NULL";
                case 6:
                    return "OBJECT_IDENTIFIER";
                case 7:
                    return "ObjectDescriptor";
                case 8:
                    return "EXTERNAL";
                case 9:
                    return "REAL";
                case 10:
                    return "ENUMERATED";
                case 11:
                    return "EMBEDDED_PDV";
                case 12:
                    return "UTF8String";
                case 16:
                    return "SEQUENCE";
                case 17:
                    return "SET";
                case 18:
                    return "NumericString";
                case 19:
                    return "PrintableString";
                case 20:
                    return "TeletexString";
                case 21:
                    return "VideotexString";
                case 22:
                    return "IA5String";
                case 23:
                    return "UTCTime";
                case 24:
                    return "GeneralizedTime";
                case 25:
                    return "GraphicString";
                case 26:
                    return "VisibleString";
                case 27:
                    return "GeneralString";
                case 28:
                    return "UniversalString";
                case 30:
                    return "BMPString";
                default:
                    return "Universal_" + bX.toString(16)
                }
            case 1:
                return "Application_" + bX.toString(16);
            case 2:
                return "[" + bX + "]";
            case 3:
                return "Private_" + bX.toString(16)
            }
        };
        bT.prototype.reSeemsASCII = /^[ -~]+$/;
        bT.prototype.content = function() {
            if (this.tag === t) {
                return null

            }
            var b0 = this.tag >> 6,
            bX = this.tag & 31,
            bZ = this.posContent(),
            bW = Math.abs(this.length);
            if (b0 !== 0) {
                if (this.sub !== null) {
                    return "(" + this.sub.length + " elem)"
                }
                var bY = this.stream.parseStringISO(bZ, bZ + Math.min(bW, z));
                if (this.reSeemsASCII.test(bY)) {
                    return bY.substring(0, 2 * z) + ((bY.length > 2 * z) ? bV: "")
                } else {
                    return this.stream.parseOctetString(bZ, bZ + bW)
                }
            }
            switch (bX) {
            case 1:
                return (this.stream.get(bZ) === 0) ? "false": "true";
            case 2:
                return this.stream.parseInteger(bZ, bZ + bW);
            case 3:
                return this.sub ? "(" + this.sub.length + " elem)": this.stream.parseBitString(bZ, bZ + bW);
            case 4:
                return this.sub ? "(" + this.sub.length + " elem)": this.stream.parseOctetString(bZ, bZ + bW);
            case 6:
                return this.stream.parseOID(bZ, bZ + bW);
            case 16:
            case 17:
                return "(" + this.sub.length + " elem)";
            case 12:
                return this.stream.parseStringUTF(bZ, bZ + bW);
            case 18:
            case 19:
            case 20:
            case 21:
            case 22:
            case 26:
                return this.stream.parseStringISO(bZ, bZ + bW);
                case 30:
                return this.stream.parseStringBMP(bZ, bZ + bW);
            case 23:
            case 24:
                return this.stream.parseTime(bZ, bZ + bW)
            }
            return null
        };
        bT.prototype.toString = function() {
            return this.typeName() + "@" + this.stream.pos + "[header:" + this.header + ",length:" + this.length + ",sub:" + ((this.sub === null) ? "null": this.sub.length) + "]"
        };
        bT.prototype.print = function(bX) {
            if (bX === t) {
                bX = ""
            }
            document.writeln(bX + this);
            if (this.sub !== null) {
                bX += "  ";
                for (var bY = 0, bW = this.sub.length; bY < bW; ++bY) {
                    this.sub[bY].print(bX)
                }
            }
        };
        bT.prototype.toPrettyString = function(bX) {
            if (bX === t) {
                bX = ""
            }
            var bZ = bX + this.typeName() + " @" + this.stream.pos;
            if (this.length >= 0) {
                bZ += "+"
            }
            bZ += this.length;
            if (this.tag & 32) {
                bZ += " (constructed)"
            } else {
                if (((this.tag == 3) || (this.tag == 4)) && (this.sub !== null)) {
                    bZ += " (encapsulates)"
                }
            }
            bZ += "\n";
            if (this.sub !== null) {
                bX += "  ";
                for (var bY = 0, bW = this.sub.length;
                bY < bW; ++bY) {
                    bZ += this.sub[bY].toPrettyString(bX)
                }
            }
            return bZ
        };
        bT.prototype.toDOM = function() {
            var b3 = bU.tag("div", "node");
            b3.asn1 = this;
            var bZ = bU.tag("div", "head");
            var b1 = this.typeName().replace(/_/g, " ");
            bZ.innerHTML = b1;
            var bX = this.content();
            if (bX !== null) {
                bX = String(bX).replace(/</g, "&lt;");
                var bW = bU.tag("span", "preview");
                bW.appendChild(bU.text(bX));
                bZ.appendChild(bW)
            }
            b3.appendChild(bZ);
            this.node = b3;
            this.head = bZ;
            var b0 = bU.tag("div", "value");
            b1 = "Offset: " + this.stream.pos + "<br/>";
            b1 += "Length: " + this.header + "+";
            if (this.length >= 0) {
                b1 += this.length
            } else {
                b1 += ( - this.length) + " (undefined)"
            }
            if (this.tag & 32) {
                b1 += "<br/>(constructed)"
            } else {
                if (((this.tag == 3) || (this.tag == 4)) && (this.sub !== null)) {
                    b1 += "<br/>(encapsulates)"
                }
            }
            if (bX !== null) {
                b1 += "<br/>Value:<br/><b>" + bX + "</b>";
                if ((typeof oids === "object") && (this.tag == 6)) {
                    var b4 = oids[bX];
                    if (b4) {
                        if (b4.d) {
                            b1 += "<br/>" + b4.d
                        }
                        if (b4.c) {
                            b1 += "<br/>" + b4.c
                        }
                        if (b4.w) {
                            b1 += "<br/>(warning!)"
                        }
                    }
                }
            }
            b0.innerHTML = b1;
            b3.appendChild(b0);
            var b2 = bU.tag("div", "sub");
            if (this.sub !== null) {
                for (var b5 = 0, bY = this.sub.length; b5 < bY; ++b5) {
                    b2.appendChild(this.sub[b5].toDOM())
                }
            }
            b3.appendChild(b2);
            bZ.onclick = function() {
                b3.className = (b3.className == "node collapsed") ? "node": "node collapsed"
            };
            return b3
        };
        bT.prototype.posStart = function() {
            return this.stream.pos
        };
        bT.prototype.posContent = function() {
            return this.stream.pos + this.header
        };
        bT.prototype.posEnd = function() {
            return this.stream.pos + this.header + Math.abs(this.length)
        };
        bT.prototype.fakeHover = function(bW) {
            this.node.className += " hover";
            if (bW) {
                this.head.className += " hover"
            }
        };
        bT.prototype.fakeOut = function(bX) {
            var bW = / ?hover/;
            this.node.className = this.node.className.replace(bW, "");
            if (bX) {
                this.head.className = this.head.className.replace(bW, "")
            }
        };
        bT.prototype.toHexDOM_sub = function(bZ, bY, b0, b1, bW) {
            if (b1 >= bW) {
                return
            }
            var bX = bU.tag("span", bY);
            bX.appendChild(bU.text(b0.hexDump(b1, bW)));
            bZ.appendChild(bX)
        };
        bT.prototype.toHexDOM = function(bX) {
            var b0 = bU.tag("span", "hex");
            if (bX === t) {
                bX = b0
            }
            this.head.hexNode = b0;
            this.head.onmouseover = function() {
                this.hexNode.className = "hexCurrent"
            };
            this.head.onmouseout = function() {
                this.hexNode.className = "hex"
            };
            b0.asn1 = this;
            b0.onmouseover = function() {
                var b2 = !bX.selected;
                if (b2) {
                    bX.selected = this.asn1;
                    this.className = "hexCurrent"
                }
                this.asn1.fakeHover(b2)
            };
            b0.onmouseout = function() {
                var b2 = (bX.selected == this.asn1);
                this.asn1.fakeOut(b2);
                if (b2) {
                    bX.selected = null;
                    this.className = "hex"
                }
            };
            this.toHexDOM_sub(b0, "tag", this.stream, this.posStart(), this.posStart() + 1);
            this.toHexDOM_sub(b0, (this.length >= 0) ? "dlen": "ulen", this.stream, this.posStart() + 1, this.posContent());
            if (this.sub === null) {
                b0.appendChild(bU.text(this.stream.hexDump(this.posContent(), this.posEnd())))
            } else {
                if (this.sub.length > 0) {
                    var b1 = this.sub[0];
                    var bZ = this.sub[this.sub.length - 1];
                    this.toHexDOM_sub(b0, "intro", this.stream, this.posContent(), b1.posStart());
                    for (var bY = 0, bW = this.sub.length; bY < bW; ++bY) {
                        b0.appendChild(this.sub[bY].toHexDOM(bX))
                    }
                    this.toHexDOM_sub(b0, "outro", this.stream, bZ.posEnd(), this.posEnd())
                }
            }
            return b0
        };
        bT.prototype.toHexString = function(bW) {
            return this.stream.hexDump(this.posStart(), this.posEnd(), true)
        };
        bT.decodeLength = function(bZ) {
            var bX = bZ.get(),
            bW = bX & 127;
            if (bW == bX) {
                return bW
            }
            if (bW > 3) {
                throw "Length over 24 bits not supported at position " + (bZ.pos - 1)
            }
            if (bW === 0) {
                return - 1
            }
            bX = 0;
            for (var bY = 0; bY < bW; ++bY) {
                bX = (bX << 8) | bZ.get()
            }
            return bX
        };
        bT.hasContent = function(bX, bW, b2) {
            if (bX & 32) {
                return true

            }
            if ((bX < 3) || (bX > 4)) {
                return false
            }
            var b1 = new L(b2);
            if (bX == 3) {
                b1.get()
            }
            var b0 = b1.get();
            if ((b0 >> 6) & 1) {
                return false
            }
            try {
                var bZ = bT.decodeLength(b1);
                return ((b1.pos - b2.pos) + bZ == bW)
            } catch(bY) {
                return false
            }
        };
        bT.decode = function(bZ) {
            if (! (bZ instanceof L)) {
                bZ = new L(bZ, 0)
            }
            var bY = new L(bZ),
            b1 = bZ.get(),
            bW = bT.decodeLength(bZ),
            b5 = bZ.pos - bY.pos,
            b2 = null;
            if (bT.hasContent(b1, bW, bZ)) {
                var b3 = bZ.pos;
                if (b1 == 3) {
                    bZ.get()
                }
                b2 = [];
                if (bW >= 0) {
                    var b4 = b3 + bW;
                    while (bZ.pos < b4) {
                        b2[b2.length] = bT.decode(bZ)
                    }
                    if (bZ.pos != b4) {
                        throw "Content size is not correct for container starting at offset " + b3
                    }
                } else {
                    try {
                        for (;;) {
                            var b0 = bT.decode(bZ);
                            if (b0.tag === 0) {
                                break
                            }
                            b2[b2.length] = b0
                        }
                        bW = b3 - bZ.pos
                    } catch(bX) {
                        throw "Exception while decoding undefined length content: " + bX
                    }
                }
            } else {
                bZ.pos += bW
            }
            return new bT(bY, b5, bW, b1, b2)
        };
        bT.test = function() {
            var b1 = [{
                value: [39],
                expected: 39
            },
            {
                value: [129, 201],
                expected: 201
            },
            {
                value: [131, 254, 220, 186],
                expected: 16702650
            }];
            for (var bY = 0, bW = b1.length; bY < bW; ++bY) {
                var b0 = 0,
                bZ = new L(b1[bY].value, 0),
                bX = bT.decodeLength(bZ);
                if (bX != b1[bY].expected) {
                    document.write("In test[" + bY + "] expected " + b1[bY].expected + " got " + bX + "\n")
                }
            }
        };
        window.ASN1 = bT
    })();
    ASN1.prototype.getHexStringValue = function() {
        var t = this.toHexString();
        var L = this.header * 2;
        var z = this.length * 2;
        return t.substr(L, z)
    };
    aU.prototype.parseKey = function(bY) {
        try {
            var b2 = 0;
            var L = 0;
            var b1 = /^\s*(?:[0-9A-Fa-f][0-9A-Fa-f]\s*)+$/;
            var t = b1.test(bY) ? Hex.decode(bY) : Base64.unarmor(bY);
            var z = ASN1.decode(t);
            if (z.sub.length === 9) {
                b2 = z.sub[1].getHexStringValue();
                this.n = bD(b2, 16);
                L = z.sub[2].getHexStringValue();
                this.e = parseInt(L, 16);
                var bT = z.sub[3].getHexStringValue();
                this.d = bD(bT, 16);
                var bV = z.sub[4].getHexStringValue();
                this.p = bD(bV, 16);
                var bZ = z.sub[5].getHexStringValue();
                this.q = bD(bZ, 16);
                var bU = z.sub[6].getHexStringValue();
                this.dmp1 = bD(bU, 16);
                var bW = z.sub[7].getHexStringValue();
                this.dmq1 = bD(bW, 16);
                var b0 = z.sub[8].getHexStringValue();
                this.coeff = bD(b0, 16)
            } else {
                if (z.sub.length === 2) {
                    var b4 = z.sub[1];
                    var bX = b4.sub[0];
                    b2 = bX.sub[0].getHexStringValue();
                    this.n = bD(b2, 16);
                    L = bX.sub[1].getHexStringValue();
                    this.e = parseInt(L, 16)
                } else {
                    return false
                }
            }
            return true
        } catch(b3) {
            return false
        }
    };
    aU.prototype.getPublicBaseKey = function() {
        var bT = {
            array: [new KJUR.asn1.DERObjectIdentifier({
                oid: "1.2.840.113549.1.1.1"
            }), new KJUR.asn1.DERNull()]
        };
        var bU = new KJUR.asn1.DERSequence(bT);
        bT = {
            array: [new KJUR.asn1.DERInteger({
                bigint: this.n
            }), new KJUR.asn1.DERInteger({
                "int": this.e
            })]
        };
        var t = new KJUR.asn1.DERSequence(bT);
        bT = {
            hex: "00" + t.getEncodedHex()
        };
        var L = new KJUR.asn1.DERBitString(bT);
        bT = {
            array: [bU, L]
        };
        var z = new KJUR.asn1.DERSequence(bT);
        return z.getEncodedHex()
    };
    aU.prototype.getPublicBaseKeyB64 = function() {
        return x(this.getPublicBaseKey())
    };
    aU.prototype.wordwrap = function(L, t) {
        t = t || 64;
        if (!L) {
            return L
        }
        var z = "(.{1," + t + "})( +|$\n?)|(.{1," + t + "})";
        return L.match(RegExp(z, "g")).join("\n")
    };
    aU.prototype.getPublicKey = function() {
        var t = "-----BEGIN PUBLIC KEY-----\n";
        t += this.wordwrap(this.getPublicBaseKeyB64()) + "\n";
        t += "-----END PUBLIC KEY-----";
        return t
    };
    aU.prototype.hasPublicKeyProperty = function(t) {
        t = t || {};
        return (t.hasOwnProperty("n") && t.hasOwnProperty("e"))
    };
    aU.prototype.parsePropertiesFrom = function(t) {
        this.n = t.n;
        this.e = t.e;
        if (t.hasOwnProperty("d")) {
            this.d = t.d;
            this.p = t.p;
            this.q = t.q;
            this.dmp1 = t.dmp1;
            this.dmq1 = t.dmq1;
            this.coeff = t.coeff
        }
    };
    var aG = function(t) {
        aU.call(this);
        if (t) {
            if (typeof t === "string") {
                this.parseKey(t)
            } else {
                if (this.hasPublicKeyProperty(t)) {
                    this.parsePropertiesFrom(t)

                }
            }
        }
    };
    aG.prototype = new aU();
    aG.prototype.constructor = aG;
    var a = function(t) {
        t = t || {};
        this.default_key_size = parseInt(t.default_key_size) || 1024;
        this.default_public_exponent = t.default_public_exponent || "010001";
        this.log = t.log || false;
        this.key = null
    };
    a.prototype.setKey = function(t) {
        if (this.log && this.key) {
            console.warn("A key was already set, overriding existing.")
        }
        this.key = new aG(t)
    };
    a.prototype.setPublicKey = function(t) {
        this.setKey(t)
    };
    a.prototype.decrypt = function(t) {
		return t;//直接返回
        try {
            return this.getKey().decrypt(bf(t))
        } catch(z) {
            return false
        }
    };
    a.prototype.encrypt = function(t) {
        try {
            return x(this.getKey().encrypt(t))
        } catch(z) {
            return false
        }
    };
    a.prototype.getKey = function(t) {
        if (!this.key) {
            this.key = new aG();
            if (t && {}.toString.call(t) === "[object Function]") {
                this.key.generateAsync(this.default_key_size, this.default_public_exponent, t);
                return
            }
            this.key.generate(this.default_key_size, this.default_public_exponent)
        }
        return this.key
    };
    a.prototype.getPublicKey = function() {
        return this.getKey().getPublicKey()
    };
    a.prototype.getPublicKeyB64 = function() {
        return this.getKey().getPublicBaseKeyB64()
    };
    bC.JSEncrypt = a
})(JSEncryptExports);

var JSEncrypt = JSEncryptExports.JSEncrypt;
var loginCookieArr = ["ut", "uname", "yihaodian_uid", "ac", "ucocode", "msessionid", "aut", "global_user_machine_sign"];
function jsonpAjaxWithTimeout(c, d) {
    jQuery.ajax({
        url: c,
        dataType: "jsonp",
        timeout: 5000,
        success: function(b, a) {
            d(b)
        },
        error: function(b, f, a) {
            d()
        }
    })
}
function getCookie(h) {
    var g = document.cookie.split(";");
    for (var e = 0; e < g.length; e++) {
        var f = g[e].split("=");
        if (f[0].replace(/(^\s*)|(\s*$)/g, "") == h) {
            return f[1]
        }
    }
    return ""
}
function jsTrim(b) {
    return b.replace(/\ /g, "")
};
var jsLoginFed = {
    ieLower: $.browser.msie && $.browser.version == 6 || false,
    helpCenterHover: function() {
        $(".help_wrap", ".regist_header_right ").hover(function() {
            $(this).addClass("help_wrap_hover")
        },
        function() {
            $(this).removeClass("help_wrap_hover")
        })
    },
    registForm: function(b) {
        var a = $(b).val();
        $(".login_form").delegate(b, "focus", 
        function() {
            if ($(this).val() == "邮箱/手机/用户名") {
                $(this).val("")
            }
            $(this).removeClass("gay_text");
            $(this).parents(".form_item").addClass("cur")
        });
        $(".login_form").delegate(b, "blur", 
        function() {
            var c = $(this).val();
            if (!c) {
                $(this).val(a).addClass("gay_text")
            }
            $(this).parents(".form_item").removeClass("cur")
        })
    },
    serviceAgreement: function() {
        $("#check_agreement").click(function() {
            if ($(this).hasClass("uncheck_agreement")) {
                $(this).attr("class", "check_agreement");
                jQuery("#isAutoLogin").attr("value", "1");
                $("#agreement_tips").show()
            } else {
                $(this).attr("class", "uncheck_agreement");
                jQuery("#isAutoLogin").attr("value", "0");
                $("#agreement_tips").hide()
            }
            return false
        })
    },
    allowAgreement: function() {
        $(".check_agreement", ".allow_info").click(function() {
            if ($(this).hasClass("uncheck_agreement")) {
                $(this).attr("class", "check_agreement")
            } else {
                $(this).attr("class", "uncheck_agreement");
                $(this).next(".agreement_tips").show()
            }
            return false
        })
    },
    jointLanding: function() {
        var a = $(".joint_landing_wrap");
        $("li:gt(4)", a).hide();
        a.delegate(".unfold", "click", 
        function() {
            var b = $(this);
            if (b.hasClass("fold")) {
                $("li:gt(4)", a).hide();
                $(this).removeClass("fold")
            } else {
                $("li:gt(4)", a).show();
                $(this).addClass("fold")
            }
        })
    },
    showService: function() {
        $(".ipt_username").blur(function() {
            var a = $(this).val();
            agree(a)
        })
    },
    loadFunLogin: function() {
        jsLoginFed.helpCenterHover();
        jsLoginFed.registForm(".ipt_username");
        jsLoginFed.registForm(".ipt_password");
        jsLoginFed.registForm(".ipt_code");
        jsLoginFed.serviceAgreement();
        jsLoginFed.jointLanding();
        jsLoginFed.showService()
    },
    loadFunThirdLogin: function() {
        jsLoginFed.registForm(".ipt_username");
        jsLoginFed.registForm(".ipt_password");
        jsLoginFed.registForm(".ipt_code");
        jsLoginFed.serviceAgreement();
        jsLoginFed.allowAgreement();
        jsLoginFed.jointLanding()
    },
    loadFunLoginFail: function() {
        jsLoginFed.helpCenterHover()
    }
};
function inputFocus() {
    $(".login_field input").focus(function() {
        $(this).addClass("cur")
    });
    $(".login_field input").blur(function() {
        $(this).removeClass("cur")
    });
    $(".login_field input").keydown(function() {
        $(".login_field span").hide()
    })
}
function focus_un() {
    $("#un").live("click keydown", 
    function() {
        if ($("#un").val() == "邮箱/手机") {
            $("#un").val("");
            $("#un").focus()
        }
    });
    $("#un").mouseover(function() {
        $("#un").focus()
    });
    $("#un").mouseout(function() {
        if (!$("#un").val()) {
            $("#un").val("邮箱/手机");
            $("#un").addClass("gay_text")
        }
    })
}
function accountValueInit(d) {
    var c = getCookie("ac");
    if (c) {
        d.val(decodeURIComponent(c));
        jQuery("#pwd").focus();
        showValidCodeForPCInit(d.val())
    } else {
        if (d.val() == "") {
            d.val("邮箱/手机/用户名");
            d.focus()
        }
    }
    return d.val()
}
function isShowValidatCodeByAccountBlur(c) {
    var d = c.val();
    c.blur(function() {
        c.removeClass("cur");
        if (showValidCode != "1" && c.val() && c.val() != "邮箱/手机" && c.val() != d) {
            d = c.val();
            var b = {
                username: c.val()
            };
			
			$.ajax({
					type:'post',
					async:false,
					data:b,
					dataType:'json',
					url:checkErrTimesUrl,
					beforeSend:function(){
						
					},
					success:function(g) {
				                if (g) {
				                    var h = $("#vcd_div");
				                    if (g>3) {
				                        passport_refresh_valid_code();
				                        h.show();
				                        $("#vcd").attr("tabindex", "3");
				                        $("#vcd").val("");
				                        $("#autoLoginDiv").hide();
				                        $("#isAutoLogin").attr("value", "0")
				                    } else {
				                        if (!h.is(":hidden")) {
				                            $("#error_tips").hide();
				                            h.hide();
				                            $("#autoLoginDiv").show();
				                            $("#autoLoginDiv").attr("tabindex", "3")
				                        }
				                    }
				                }
					},
					error:function(){
						
					},
					complete:function(){
						
					},
					timeout:1000,
				})
  
        }
    })
}
function showValidCodeForPCInit(d) {
    if (showValidCode == "1") {
        return
    }
    var e = {
        "credentials.username": d
    };
    var f = URLPrefix.passport + "/publicPassport/showValidate.do";
    jQuery.post(f, e, 
    function(a) {
        if (a) {
            var b = $("#vcd_div");
            if (a.ShowValidCode == 1) {
                passport_refresh_valid_code();
                b.show();
                $("#vcd").attr("tabindex", "3");
                $("#vcd").val("");
                $("#autoLoginDiv").hide();
                $("#isAutoLogin").attr("value", "0")
            } else {
                if (!b.is(":hidden")) {
                    $("#error_tips").hide();
                    b.hide();
                    $("#autoLoginDiv").show();
                    $("#autoLoginDiv").attr("tabindex", "3")
                }
            }
        }
    })
}
function isShowAuto() {
    if (autoLoginFlag == 1) {
        $("#check_agreement").click()
    }
}
function isShowValidCode() {
    if (showValidCode == "1") {
        passport_refresh_valid_code();
        $("#vcd_div").show();
        $("#vcd").attr("tabindex", "3");
        $("#vcd").val("");
        $("#autoLoginDiv").hide();
        $("#isAutoLogin").attr("value", "0")
    } else {
        $("#vcd_div").hide()
    }
    if (jQuery("#vcd")) {
        $("#vcd").blur(function() {
            $("#vcd").removeClass("cur");
            if ($("#vcd").val() == "") {
                $("#error_tips").text("请输入验证码");
                $("#error_tips").show()
            }
        })
    }
}
function getCookie(h) {
    var g = document.cookie.split(";");
    for (var e = 0; e < g.length; e++) {
        var f = g[e].split("=");
        if (f[0].replace(/(^\s*)|(\s*$)/g, "") == h) {
            return f[1]
        }
    }
    return ""
}
function passport_refresh_valid_code() {
    var c = $("#valid_code_pic");
    if (c) {
        var d = "/passport/valid_code.do";
        if (valid_code_service_flag == 1) {
            getValidateSigAndSetImageSrc(c)
        } else {
            c.attr("src", d + "?t=" + Math.random())
        }
    }
}
function getValidateSigAndSetImageSrc(b) {
    $.ajax({
        type: "GET",
        dataType: "jsonp",
        jsonp: "callback",
        url: "https://captcha.yhd.com/public/getsig.do?t=" + Math.random(),
        success: function(a) {
            var e = a.sig;
            jQuery("#validateSig").val(e);
            var f = "https://captcha.yhd.com/public/getjpg.do?sig=" + e;
            b.attr("src", f)
        }
    })
}
function doEnter() {
    $("#pwd,#vcd,#login_button").keydown(function(b) {
        if (b.keyCode == 13) {
            if (jQuery.browser.msie && jQuery.browser.version == "6.0") {
                jQuery("#login_button").trigger("click")
            } else {
                jQuery("#login_button").click()
            }
        }
    })
}
function showErrorInfo(d, c) {
    $("#error_tips").text(c);
    $("#error_tips").show();
    if (d != null) {
        d.focus()
    }
}
function clearErrorInfo() {
    $("#error_tips").text("");
    $("#error_tips").hide()
}
function stringTrim(b) {
    return b.replace(/(^\s*)|(\s*$)/g, "")
}
function stringLen(c) {
    c = stringTrim(c);
    var d = 0;
    if (c) {
        d = c.replace(/[^\x00-\xff]/g, "***").length
    }
    return d
}
function checkValidCodeOnBlur() {
    var b = jQuery("#vcd").val();
    if (b == "") {
        jQuery("#code_right").hide();
        jQuery("#code_wrong").show();
        $("#error_tips").text("请输入验证码");
        $("#error_tips").show()
    } else {
        if (b.length != 5) {
            jQuery("#code_right").hide();
            jQuery("#code_wrong").show();
            $("#error_tips").text("请输入5位验证码");
            $("#error_tips").show()
        }
    }
}
var vcdPCLogin;
function login_param_validate() {
    var d = $("#vcd").val();
    if (d.length != 5 || d == vcdPCLogin) {
        return
    }
    vcdPCLogin = d;
    var e = {
        validCode: d,
        sig: jQuery("#validateSig").val()
    };
    var f = URLPrefix.passport + "/publicPassport/login_param_validate.do";
    jQuery.post(f, e, 
    function(a) {
        if (a) {
            if (a.errorCode != 0) {
                if (a.errorCode == 1) {
                    jQuery("#code_right").hide();
                    jQuery("#code_wrong").show();
                    if (a.refresh) {
                        if (a.refresh == 1) {
                            passport_refresh_valid_code()
                        }
                    }
                    showErrorInfo($("#vcd"), "验证码错误，请重新输入")
                }
            } else {
                jQuery("#code_right").show();
                jQuery("#code_wrong").hide();
                clearErrorInfo()
            }
        } else {
            jQuery("#code_right").hide();
            jQuery("#code_wrong").show();
            clearErrorInfo()
        }
    })
}
function button_recover() {
    $("#login_button").removeAttr("disabled");
    $("#login_button").text("登录")
}
function double_submit() {
    $("#login_button").attr("disabled", "disabled");
    $("#login_button").text("登录中...");
    $("#error_tips").hide();
    var j = $("#un").val();
    var p = $("#pwd").val();
    var o = $("#vcd").val();
    if (p == "" && (j == "" || j == "邮箱/手机/用户名")) {
        showErrorInfo($("#un"), "请输入账号和密码");
        button_recover();
        return false
    }
    if (j == "" || j == "邮箱/手机/用户名") {
        showErrorInfo($("#un"), "请输入账号");
        button_recover();
        return false
    } else {
        if (stringLen(j) > 100) {
            showErrorInfo($("#un"), "账号长度不能超过100位");
            button_recover();
            return false
        } else {
            if (j.toLowerCase().indexOf("<script") > -1 || j.toLowerCase().indexOf("<\/script") > -1) {
                showErrorInfo($("#un"), "账号中包含非法字符");
                button_recover();
                return false
            }
        }
    }
    var l = /\s+/;
    if (p == "") {
        showErrorInfo($("#pwd"), "请输入密码");
        button_recover();
        return false
    } else {
        if (l.test(p)) {
            showErrorInfo($("#pwd"), "密码不能有空格");
            button_recover();
            return false
        }
    }
    if (!$("#vcd_div").is(":hidden")) {
        if (o == "") {
            showErrorInfo($("#vcd"), "请输入验证码");
            button_recover();
            return false
        }
    }
   // var m = new JSEncrypt();
   // m.setPublicKey(pubkey);
   // p = m.encrypt(p);
   // j = m.encrypt(j);
    var k = "";
    var n = document.getElementById("__yct_str__");
    if (null != n) {
        k = n.value
    }
    var q = {
        login_info: j,
        password: p,
        validCode: o,
       // sig: jQuery("#validateSig").val(),
      //  captchaToken: k,
      //  loginSource: $("#login_source").val(),
      //  returnUrl: returnUrl,
        isAutoLogin: jQuery("#isAutoLogin").val()
    };
    var r = logPath;
	
	$.ajax({
			type:'post',
			async:false,
			data:q,
			dataType:'json',
			url:logPath,
			beforeSend:function(){
				
			},
			success:function(e){
				 if (e) {
				 	if(e.errorCode !=0){
						switch(e.errorCode){
							case 1 :{
								showErrorInfo($("#un"), "账号不能为空");
								break;
							}
							case 2 : {
								 showErrorInfo($("#pwd"), "密码不能为空");
								 break;
							}
							case 13 : {
								showErrorInfo($("#un"), "您的账号有安全风险已冻结，请致电"+servicePhone+"解冻");
								break;
							}
							case 10 : {
								 showErrorInfo($("#un"), "验证码错误，请重新输入");
								 break;
							}
							case 9 : {
								showErrorInfo($("#un"), "您的账号已被锁定");
								 break;
							}
							case 15 : {
								showErrorInfo($("#un"), "您的账号已被删除");
								 break;
							}
							case 7 : {
								showErrorInfo($("#un"), "账号密码不匹配");
								if(e.errorTimes>3){
									showValidCode = '1';
									isShowValidCode();
								}
								
								 break;
							}
						}
						
						
					}else{
						if(e.errorCode ==0){
							if(e.returnUrl)
								returnUrl = e.returnUrl;
		                    window.location = returnUrl;
		                    return
						}
					}
					button_recover();
				 }
			},
			complete:function(){
				button_recover();
			},
			timeout:1000,
		})
	
	
   
}
function loginPopBindPhoneBox(d) {
    var c = URLPrefix.passport + "/passport/login_pop_bind_phone_box.do";
    jQuery.post(c, 
    function(b) {
        if (b) {
            if (b.result == 1) {
                var a = '<div class="popup_win_mask"></div><div class="mod_bindmb_point"><span class="close_btn" onclick="closeLoginBindPhonePop()" ></span><div class="form_box"><p><label>手机号：</label><input type="text" id="loginBindPhone" maxlength="11" class="ipt" onchange="loginBindPhoneChange()" /></p><p><label>验证码：</label><input type="text" class="ipt ipt_code" id="validCodeMobile" maxlength="11" /><a href="#" class="code_btn receive_code" onclick="loginBindPhoneSendSmsCaptcha()" >获取验证码</a></p><p class="error_tips_box"></p><a href="#" class="bind_btn" onclick="loginBindPhoneAndSendPoints()" >绑定送200积分</a><input type="hidden" id="returnUrl" value="' + d + '" /></div></div>';
                jQuery(".mod_login_bindmb_point").html(a);
                return
            }
        }
        window.location = d
    })
}
function loginBindPhoneSendSmsCaptcha() {
    if (jQuery(".mod_bindmb_point a.receive_code").hasClass("reacquire_code")) {
        return
    }
    var f = jQuery("#loginBindPhone").val();
    var j = jQuery(".mod_bindmb_point p.error_tips_box");
    j.html("");
    if (f == "") {
        j.html("*手机号不能为空");
        return
    }
    var h = /^1\d{10}$/;
    if (!h.test(f)) {
        j.html("*格式错误，请输入正确手机号码");
        return
    }
    var g = {
        phone: f
    };
    var i = URLPrefix.passport + "/passport/login_bind_phone_send_sms_captcha.do";
    jQuery.post(i, g, 
    function(a) {
        if (a.result == 0) {
            loginSmsCodeCountdown()
        } else {
            if (a.result == 16) {
                j.html("*手机号已存在")
            } else {
                if (a.result == 17) {
                    j.html("*24小时内最多只能获取验证码3次")
                } else {
                    if (a.result == -1) {
                        j.html("*验证码发送失败")
                    } else {
                        if (a.result == -2) {
                            alert("操作异常");
                            window.location = "http://www.yhd.com"
                        }
                    }
                }
            }
        }
    })
}
var loginRecvCodeCountdownTime = null;
function loginSmsCodeCountdown() {
    jQuery(".mod_bindmb_point a.receive_code").addClass("reacquire_code").html("重新获取验证码(<i>59</i>)");
    var b = jQuery("i", ".mod_bindmb_point a.reacquire_code").text();
    loginRecvCodeCountdownTime = setInterval(function() {
        if (b > 0) {
            b--;
            jQuery("i", ".mod_bindmb_point a.reacquire_code").text(b)
        } else {
            clearInterval(loginRecvCodeCountdownTime);
            loginRecvCodeCountdownTime = null;
            jQuery(".mod_bindmb_point a.receive_code").removeClass("reacquire_code").html("获取验证码")
        }
    },
    1000)
}
function loginBindPhoneChange() {
    clearInterval(loginRecvCodeCountdownTime);
    loginRecvCodeCountdownTime = null;
    $(".mod_bindmb_point a.receive_code").removeClass("reacquire_code").html("获取验证码");
    jQuery(".mod_bindmb_point p.error_tips_box").html("")
}
function loginBindPhoneAndSendPoints() {
    var g = jQuery("#loginBindPhone").val();
    var l = jQuery(".mod_bindmb_point p.error_tips_box");
    l.html("");
    if (g == "") {
        l.html("*手机号不能为空");
        return
    }
    var i = /^1\d{10}$/;
    if (!i.test(g)) {
        l.html("*格式错误，请输入正确手机号码");
        return
    }
    var j = jQuery("#validCodeMobile").val();
    if (j == "") {
        l.html("*验证码不能为空");
        return
    } else {
        if (j.length != 6) {
            l.html("*格式错误，请输入6位验证码");
            return
        }
    }
    var h = {
        phone: g,
        validCodeMobile: j,
        returnUrl: jQuery("#returnUrl").val()
    };
    var k = URLPrefix.passport + "/passport/login_bind_phone_and_send_points.do";
    jQuery.post(k, h, 
    function(a) {
        if (a.result == 0) {
            window.location = a.returnUrl
        } else {
            if (a.result == 1) {
                l.html("*手机号绑定失败")
            } else {
                if (a.result == 2) {
                    l.html("*验证码错误")
                } else {
                    if (a.result == -1) {
                        alert("操作异常");
                        window.location = a.returnUrl
                    }
                }
            }
        }
    })
}
function closeLoginBindPhonePop() {
    jQuery(".mod_login_bindmb_point").hide();
    window.location = jQuery("#returnUrl").val()
}
function resetLocation(f, g) {
    var h = g;
    if ($("#login_source").val() == LOGIN_SOURCE.FRAME) {
        if (g && g.lastIndexOf("/cart/cart.do?action=view") < 0) {
            var e = encodeURIComponent(g);
            h = resetIframeUrl + "?result=" + f + "&exceptionUrl=" + e

        } else {
            h = resetIframeUrl + "?result=" + f
        }
    }
    window.location = h
}
function showAgreeNewContract(l, j, m, k) {
    var h = "";
    h = URLPrefix.passport;
    var n = encodeURIComponent(j);
    var i = h + "/legal/showNewContract.do?random=" + l + "&returnUrl=" + n + "&isAutoLogin=" + k;
    if (m) {
        i = m + "?result=" + LOGIN_RESULT.FAIL + "&exceptionUrl=" + encodeURIComponent(i)
    }
    window.location = i
}
function partnerCouponRegister() {
    window.location = URLPrefix.passport + "/passport/register_input.do?returnUrl=" + encodeURIComponent(returnUrl)
}
function agree(f) {
    var e = {
        username: f
    };
    var d = URLPrefix.passport + "/passport/agree.do";
    jQuery.post(d, e, 
    function(a) {
        if (a) {
            if (a.show) {
                $(".service_agreement").slideDown();
                $(".service_agreement").css("display", "inline-block")
            } else {
                $(".service_agreement").slideUp()
            }
        }
    })
}
function pageInit() {
    jsLoginFed.loadFunLogin();
    accountValueInit(jQuery("#un"));
    isShowValidatCodeByAccountBlur(jQuery("#un"));
    inputFocus();
    isShowValidCode();
    doEnter();
    focus_un();
    landingBox();
    agree($("#un").val());
    $(document).ready(function() {
        var b = URLPrefix.passport + "/passport/english/login_input.do";
        $("#edition").show().attr("href", b)
    })
}
function loadImageUrl(g, h) {
    var f = {
        adCode: g
    };
    var e = "/passport/loadAd.do";
    jQuery.post(e, f, 
    function(a) {
        if (a) {
            if (a.imageUrl) {
                $("#img").attr("src", a.imageUrl);
                if (a.linkUrl) {
                    $("#imgLink").attr("href", a.linkUrl);
                    $("#imgLink").click(function() {
                        addTrackPositionToCookie("1", h)
                    })
                }
            } else {
                $("#img").attr("src", imgPath + "/login_pic.jpg")
            }
        } else {
            $("#img").attr("src", imgPath + "/login_pic.jpg")
        }
    })
}
function landingBox() {
    var b = $(".login_entry");
    b.delegate(".unfold", "click", 
    function() {
        var a = $(this);
        if (a.hasClass("fold")) {
            $(".account_list", b).hide();
            $(this).removeClass("fold")

        } else {
            $(".account_list", b).show();
            $(this).addClass("fold")
        }
    })
}
function sinaAuthLoginInit() {
    pageInit();
    yhdLib.popwin({
        clickid: ".serve_agreement",
        poptitle: "新浪网络服务使用协议",
        popcontent: ".sinaProtocol"
    });
    $(".config_ok1").live("click", 
    function() {
        $(".chkBox").attr("checked", "true");
        yhdLib.popclose()
    })
}
function yaoWangAuthLogin() {
    $("#login_button").attr("disabled", "disabled");
    $("#login_button").text("登录中...");
    $("#error_tips").hide();
    var l = $("#un").val();
    var r = $("#pwd").val();
    var q = $("#vcd").val();
    if (r == "" && (l == "" || l == "邮箱/手机/用户名")) {
        showErrorInfo($("#un"), "请输入账号和密码");
        button_recover();
        return false
    }
    if (l == "" || l == "邮箱/手机/用户名") {
        showErrorInfo($("#un"), "请输入账号");
        button_recover();
        return false
    } else {
        if (stringLen(l) > 100) {
            showErrorInfo($("#un"), "账号长度不能超过100位");
            button_recover();
            return false
        } else {
            if (l.toLowerCase().indexOf("<script") > -1 || l.toLowerCase().indexOf("<\/script") > -1) {
                showErrorInfo($("#un"), "账号中包含非法字符");
                button_recover();
                return false
            }
        }
    }
    var n = /\s+/;
    if (r == "") {
        showErrorInfo($("#pwd"), "请输入密码");
        button_recover();
        return false
    } else {
        if (n.test(r)) {
            showErrorInfo($("#pwd"), "密码不能有空格");
            button_recover();
            return false
        }
    }
    if (!$("#vcd_div").is(":hidden")) {
        if (q == "") {
            showErrorInfo($("#vcd"), "请输入验证码");
            button_recover();
            return false
        }
    }
    var o = new JSEncrypt();
    o.setPublicKey(pubkey);
    r = o.encrypt(r);
    l = o.encrypt(l);
    var k = jQuery("#validateSig").val();
    var m = "";
    var p = document.getElementById("__yct_str__");
    if (null != p) {
        m = p.value
    }
    var s = {
        "credentials.username": l,
        "credentials.password": r,
        validCode: q,
        sig: k,
        captchaToken: m,
        loginSource: $("#login_source").val(),
        isJointLogin: 1
    };
    var t = "/publicPassport/login.do";
    jQuery.post(t, s, 
    function(a) {
        if (a) {
            if (a.errorCode != 0) {
                jQuery("#code_right").hide();
                if (a.ShowValidCode == 1) {
                    $("#autoLoginDiv").hide();
                    $("#isAutoLogin").attr("value", "0");
                    passport_refresh_valid_code();
                    $("#vcd_div").show();
                    $("#vcd").attr("tabindex", "3")
                }
                if (a.errorCode == 1) {
                    showErrorInfo($("#un"), "账号不能为空")
                } else {
                    if (a.errorCode == 2) {
                        showErrorInfo($("#pwd"), "密码不能为空")
                    } else {
                        if (a.errorCode == 4) {
                            showErrorInfo($("#pwd"), "登录异常，请重新登录")
                        } else {
                            if (a.errorCode == 5) {
                                window.location.href = "/passport/goToPage.do"
                            } else {
                                if (a.errorCode == 7) {
                                    showErrorInfo($("#un"), "账号和密码不匹配，请重新输入")
                                } else {
                                    if (a.errorCode == 9) {
                                        showErrorInfo($("#pwd"), "密码错误")
                                    } else {
                                        if (a.errorCode == 10) {
                                            showErrorInfo($("#un"), "验证码错误，请重新输入")
                                        } else {
                                            if (a.errorCode == 11 || a.errorCode == 30) {
                                                showErrorInfo($("#un"), "登录异常，请输入验证码")
                                            } else {
                                                if (a.errorCode == 13) {
                                                    showErrorInfo($("#un"), "您的账号有安全风险已冻结，请致电400-007-1111解冻")
                                                } else {
                                                    if (a.errorCode == 14) {
                                                        showErrorInfo($("#vcd"), "登录异常，请输入验证码")
                                                    } else {
                                                        if (a.errorCode == 29 || a.errorCode == 31) {
                                                            jQuery("#loginform").submit()

                                                        } else {
                                                            if (a.errorCode == 15) {
                                                                showErrorInfo($("#un"), "登录异常，请重新登录")
                                                            } else {
                                                                if (a.errorCode == 16) {
                                                                    window.location.href = "/passport/toSafeNoticFrom.do"
                                                                } else {
                                                                    if (a.errorCode == 17) {
                                                                        showErrorInfo($("#un"), "您的账户异常，预计1个工作日内处理完毕")
                                                                    } else {
                                                                        if (a.errorCode == 18) {
                                                                            showErrorInfo($("#pwd"), "密码错还可试2次")
                                                                        } else {
                                                                            if (a.errorCode == 19) {
                                                                                showErrorInfo($("#pwd"), "密码错还可试1次")
                                                                            } else {
                                                                                if (a.errorCode == 20) {
                                                                                    window.location.href = "/passport/goToPage.do"
                                                                                } else {
                                                                                    if (a.errorCode == 24) {
                                                                                        showErrorInfo($("#un"), "登录异常，请重新登录")
                                                                                    } else {
                                                                                        if (a.errorCode == 26) {
                                                                                            showErrorInfo($("#un"), "登录异常，请重新登录")
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
                if (a.errorCode == 0) {
                    jQuery("#loginform").submit();
                    setTimeout("button_recover()", 3000);
                    return
                }
            }
        }
        button_recover()
    })
};