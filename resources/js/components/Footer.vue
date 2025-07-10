<template>
    <footer class="app-footer">
        <!-- Sosyal Medya Butonları -->
        <div class="social-section">
            <div class="container">
                <h3 class="social-title">Bizi Takip Edin</h3>
                <div class="social-buttons">
                    <q-btn round size="lg" class="social-btn facebook" @click="openSocialLink('facebook')">
                        <font-awesome-icon :icon="['fab', 'facebook-f']" />
                    </q-btn>
                    <q-btn round size="lg" class="social-btn twitter" @click="openSocialLink('twitter')">
                        <font-awesome-icon :icon="['fab', 'twitter']" />
                    </q-btn>
                    <q-btn round size="lg" class="social-btn instagram" @click="openSocialLink('instagram')">
                        <font-awesome-icon :icon="['fab', 'instagram']" />
                    </q-btn>
                    <q-btn round size="lg" class="social-btn telegram" @click="openSocialLink('telegram')">
                        <font-awesome-icon :icon="['fab', 'telegram']" />
                    </q-btn>
                    <q-btn round size="lg" class="social-btn youtube" @click="openSocialLink('youtube')">
                        <font-awesome-icon :icon="['fab', 'youtube']" />
                    </q-btn>
                </div>
            </div>
        </div>

        <!-- Banner Resimleri -->
        <div class="banners-section">
            <div class="banner-images">
                <div class="banner-item">
                    <img src="/images/betsapifooter.png" alt="Güvenli Ödeme" />
                </div>
                <div class="banner-item">
                    <img src="/images/footer-payments.png" alt="Lisanslı Site" />
                </div>
            </div>
        </div>

        <!-- Copyright ve Hukuki Bilgiler -->
        <div class="copyright-section">
            <div class="container">
                <div class="footer-content">
                    <div class="footer-links">
                        <a href="#" class="footer-link">Gizlilik Politikası</a>
                        <span class="separator">|</span>
                        <a href="#" class="footer-link">Kullanım Şartları</a>
                        <span class="separator">|</span>
                        <a href="#" class="footer-link">Sorumlu Oyun</a>
                        <span class="separator">|</span>
                        <a href="#" class="footer-link">İletişim</a>
                    </div>
                    <div class="copyright-text">
                        <p>© 2025 Olden Bet. Tüm hakları saklıdır.</p>
                        <p class="disclaimer">
                            18+ yaş sınırı geçerlidir. Kumar bağımlılığına karşı önlem alınız.
                            Sorumlu oyun oynayınız.
                        </p>
                    </div>
                    <div class="license-info">
                        <p>Curacao Gaming License</p>
                        <p>License No: 8048/JAZ2020-013</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
    name: 'AppFooter',

    setup() {
        const socialLinks = {
            facebook: 'https://facebook.com/oldenbetofficial',
            twitter: 'https://twitter.com/oldenbetofficial',
            instagram: 'https://instagram.com/oldenbetofficial',
            telegram: 'https://t.me/oldenbetofficial',
            youtube: 'https://youtube.com/oldenbetofficial'
        }

        const openSocialLink = (platform: keyof typeof socialLinks) => {
            window.open(socialLinks[platform], '_blank')
        }

        return {
            openSocialLink
        }
    }
})
</script>

<style scoped>
.app-footer {
    background: #14171f;
    border-top: 1px solid #333;
    margin-top: 60px;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Sosyal Medya Bölümü */
.social-section {
    padding: 40px 0;
    background: linear-gradient(135deg, #1a1d25 0%, #20242e 100%);
}

.social-title {
    text-align: center;
    color: #fff;
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 30px;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.social-buttons {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.social-btn {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.social-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%);
    transform: translateX(-100%);
    transition: transform 0.6s;
}

.social-btn:hover::before {
    transform: translateX(100%);
}

.social-btn:hover {
    transform: translateY(-5px) scale(1.1);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
}

.facebook {
    background: linear-gradient(135deg, #1877f2 0%, #42a5f5 100%);
}

.twitter {
    background: linear-gradient(135deg, #1da1f2 0%, #42a5f5 100%);
}

.instagram {
    background: linear-gradient(135deg, #e4405f 0%, #f093fb 50%, #f5576c 100%);
}

.telegram {
    background: linear-gradient(135deg, #0088cc 0%, #42a5f5 100%);
}

.youtube {
    background: linear-gradient(135deg, #ff0000 0%, #ff5722 100%);
}

/* Banner Bölümü */
.banners-section {
    background: #1a1d25;
    padding: 20px 0;
}

.banner-images {
    display: flex;
    flex-direction: column;
    gap: 15px;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.banner-item {
    border-radius: 8px;
    overflow: hidden;
    background: #20242e;
    padding: 10px;
}

.banner-item img {
    width: 100%;
    height: auto;
    object-fit: contain;
    display: block;
    border-radius: 4px;
}

/* Copyright Bölümü */
.copyright-section {
    padding: 30px 0;
    background: #0f1117;
    border-top: 1px solid #333;
}

.footer-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
    text-align: center;
}

.footer-links {
    display: flex;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
    justify-content: center;
}

.footer-link {
    color: #00ff88;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: color 0.3s ease;
}

.footer-link:hover {
    color: #00cc6a;
    text-decoration: underline;
}

.separator {
    color: #666;
    font-size: 14px;
}

.copyright-text {
    color: #ccc;
    line-height: 1.6;
}

.copyright-text p {
    margin: 5px 0;
    font-size: 14px;
}

.disclaimer {
    font-size: 12px !important;
    color: #999 !important;
    font-style: italic;
}

.license-info {
    color: #999;
    font-size: 12px;
    text-align: center;
}

.license-info p {
    margin: 2px 0;
}

/* Responsive Tasarım */
@media (max-width: 768px) {
    .social-title {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .social-buttons {
        gap: 15px;
    }

    .social-btn {
        width: 50px;
        height: 50px;
    }

    .banner-images {
        flex-direction: column;
        gap: 10px;
        padding: 0 15px;
    }

    .banner-item {
        padding: 8px;
    }

    .footer-links {
        flex-direction: column;
        gap: 10px;
    }

    .separator {
        display: none;
    }

    .copyright-text p {
        font-size: 13px;
    }

    .container {
        padding: 0 15px;
    }
}

@media (max-width: 480px) {
    .social-buttons {
        gap: 10px;
    }

    .social-btn {
        width: 45px;
        height: 45px;
    }

    .social-title {
        font-size: 20px;
    }
}
</style>